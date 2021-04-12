<?php
include "../includes/form-logic-intro.php";

$email =$_POST['email'];
$password = md5($_POST['password']);
$user = null;

// Check if email was provided.
if (!$email) {
    $errors['email'] = 'field cannot be left empty';
}

// Check if email exists in storage.
if (!isset($errors['email'])) {
    $sql = /** @lang text */
        "Select * from `users_info` where `email` = '{$email}'";
    $result = $conn->query($sql);
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

if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header('Location:../pages/login.php');
    exit;
}

//login users
$_SESSION['user'] = $user;
header('location:../index.php');
exit();