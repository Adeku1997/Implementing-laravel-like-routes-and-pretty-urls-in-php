<?php

use Models\User;

/**
 * Redirect to the given page.
 *
 * @param string $page
 */
function redirectTo(string $page)
{
    header('Location:' . route($page));
    exit();
}

/**
 * Create a success message.
 *
 * @param string $message
 */
function setSuccess(string $message)
{
    $_SESSION['success'] = $message;
}

/**
 * Create an error message.
 *
 * @param string $message
 */
function setError(string $message)
{
    $_SESSION['error'] = $message;
}

/**
 * Fill the error bag with the provided errors.
 *
 * @param array $errors
 */
function fillErrorBag(array $errors)
{
    $_SESSION['errors'] = $errors;
}

/**
 * Create an action url.
 *
 * @param string $action
 * @return string
 */
function route(string $action): string
{
    return "/{$action}";
}

/**
 * Create a view.
 *
 * @param string $page
 * @param array $data
 */
function view(string $page, array $data = [])
{
    extract($data);

    include "../includes/form-intro.php";
    require "../pages/{$page}.php";
}

/**
 * Create an error view.
 *
 * @param int $code
 */
function abort(int $code)
{
    http_response_code($code);

    $file = "../pages/errors/{$code}.php";

    if (!file_exists($file)) {
        die("Error $code");
    }

    require "{$file}";

    exit();
}

/**
 * Get the logged in user.
 *
 * @return false|User|null
 */
function auth()
{
    if (!isset($_SESSION['user'])) {
        return false;
    }

    return $_SESSION['user'];
}

/**
 * Dump and die.
 *
 * @param mixed ...$expressions
 */
function dd(...$expressions) {
    foreach ($expressions as $expression) {
        var_dump($expression);
        print_r("\n");
    }

    die();
}
