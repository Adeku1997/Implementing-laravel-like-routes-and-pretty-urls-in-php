<?php

$fields = [];
$errors = [];
$error_response = '';
$success_response = '';

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    $fields = $_SESSION['fields'];

    unset($_SESSION['errors'], $_SESSION['fields']);
}

if (isset($_SESSION['error'])) {
    $error_response = $_SESSION['error'];

    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    $success_response = $_SESSION['success'];

    unset($_SESSION['success']);
}
