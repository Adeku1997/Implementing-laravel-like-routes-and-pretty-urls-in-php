<?php
session_start();
require ('../db.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die($_SERVER['REQUEST_METHOD'] . 'method is not allowed');
}

$_SESSION['fields'] = $_POST;
$errors = [];