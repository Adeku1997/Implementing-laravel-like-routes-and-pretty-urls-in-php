<?php

namespace Controllers;

/**
 * class LoginController
 */
class _LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showForm()
    {
        require '../includes/guest-guard.php';

        view('login');
    }

    /**
     * login a user
     *
     * @param array $data
     */
    public function login(array $data)
    {
        // 1 validate data
        $user = $this->validateUser($data);
        // 2 login the user
        $this->logUserIn($user);

        // 3 redirect to index page
        setSuccess('Login Successful');
        redirectTo('home');
    }

    /**
     * Validate login request
     *
     * @param array $data
     * @return array|null
     */
    public function validateUser(array $data): array
    {
        $errors = [];

        $email = $data['email'];
        $password = $data['password'];
        $user = null;

        if (!$email) {
            $errors['email'] = 'field cannot be left empty';
        }

        // Check if email exists in storage.
        if (!isset($errors['email'])) {
            $sql = /** @lang text */
                "Select * from `users` where `email` = '{$email}'";
            $result = $this->conn->query($sql);
            $user = $result->fetch_assoc();

            if (!$user) {
                $errors['email'] = 'The selected email is invalid.';
            }
        }

        if (!$password) {
            $errors['password'] = 'field cannot be left empty';
        }

        if (!isset($errors['password']) && $user['password'] !== md5($password)) {
            $errors['password'] = 'Incorrect password provided.';
        }

        if (!count($errors)) {
            return $user;
        }

        fillErrorBag($errors);
        redirectTo('login');
    }

    /**
     * Log the provided user in.
     *
     * @param array $user
     */
    private function logUserIn(array $user)
    {
        $_SESSION['user'] = $user;
    }
}