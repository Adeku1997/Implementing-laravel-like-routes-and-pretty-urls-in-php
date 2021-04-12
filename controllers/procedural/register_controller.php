<?php
include "../includes/form-logic-intro.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!$name) {
    $errors['name'] = 'field cannot be left empty';
}


if (!$email) {
    $errors['email'] = 'field cannot be left empty';
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'email format is not correct';
}

if (!isset($errors['email'])) {
    $sql = /** @lang text */
        "Select * from `users_info` where `email` = '{$email}'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if($user){
        $errors['email'] = 'E-mail already exists';
    }
}

if (!$password) {
    $errors['password'] = 'field cannot be left empty';
}

if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header('Location:../pages/register.php');
    exit;
}


$name =htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$password =htmlspecialchars($_POST['password']);

$sql = "INSERT INTO users_info (name,email,password)
VALUES('$name','$email',md5('$password'))";
$result = $conn->query($sql);

if (!$result) {
    $_SESSION['error'] = "Error creating record: {$conn->error}";

    header('Location:new_form.php');
    exit;
}
$_SESSION['success'] = "Account created successfully";
header('Location:../pages/register.php');



