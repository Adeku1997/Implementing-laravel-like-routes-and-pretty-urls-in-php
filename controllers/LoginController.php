<?php

namespace Controllers;

use Models\User;

/**
 * class LoginController
 */
class LoginController extends Controller
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
     * @return array|User|null
     */
    public function validateUser(array $data)
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
            $user = (new User())->fetchWithCondition('email', $email);

            if (!$user) {
                $errors['email'] = 'The selected email is invalid.';
            }
        }

        if (!$password) {
            $errors['password'] = 'field cannot be left empty';
        }

        if (!isset($errors['password']) && $user->password !== md5($password)) {
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
     * @param User $user
     */
    private function logUserIn(User $user)
    {
        $_SESSION['user'] = $user;
    }


    public function logout(){

        session_start();
        session_destroy();
        redirectTo('login');



    }
}