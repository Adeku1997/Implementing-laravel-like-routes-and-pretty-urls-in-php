<?php

namespace Controllers;

/**
 * Class RegistrationController
 */
class RegistrationController extends Controller
{
    /**
     * RegistrationController constructor.
     */
    public function __construct()
    {
        require '../includes/guest-guard.php';
        parent::__construct();
    }

    /**
     * Show the registration page.
     */
    public function showForm()
    {
        view('register');
    }

    /**
     * Register a new user.
     *
     * @param array $data
     */
    public function register(array $data)
    {
        // 1. Validate data.
        $this->validateRegister($data);

        // 2. Insert into database.
        $user = $this->addUser($data);

        // 3. Log the user in.
        $this->logUserIn($user);

        // 3. Redirect to dashboard with success message.
        setSuccess('Account created successfully');
        redirectTo('home');
    }

    /**
     * Validate the register request.
     *
     * @param array $data
     */
    private function validateRegister(array $data)
    {
        $errors = [];

        $email = $data['email'];
        $password = $data['password'];

        if (!$data['name']) {
            $errors['name'] = 'field cannot be left empty';
        }

        if (!$email) {
            $errors['email'] = 'field cannot be left empty';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'email format is not correct';


        if (!isset($errors['email'])) {
            $sql = /** @lang text */
                "Select * from `users` where `email` = '{$email}'";
            $result = $this->conn->query($sql);
            $user = $result->fetch_assoc();


            if ($user) {
                $errors['email'] = 'E-mail already exists';
            }
        }

        if (!$password) {
            $errors['password'] = 'field cannot be left empty';
        }

        if (!count($errors)) {
            return;
        }

        fillErrorBag($errors);
        redirectTo('register');
    }

        /**
         * Save the user data into storage.
         *
         * @param array $data
         * @return array|null
         */
        private
        function addUser(array $data): array
        {
            $name = htmlspecialchars($data['name']);
            $email = $data['email'];
            $password = $data['password'];

            $sql = /** @lang text */
                "INSERT INTO users (name,email,password)
                            VALUES('$name','$email',md5('$password'))";

            $result = $this->conn->query($sql);

            if (!$result) {
                setError("Error creating record: {$this->conn->error}");
                redirectTo('show-register');
            }

            $data['id'] = $this->conn->insert_id;

            return $data;
        }

        /**
         * Log the provided user in.
         *
         * @param array $user
         */
        private
        function logUserIn(array $user)
        {
            $_SESSION['user'] = $user;
        }


}
