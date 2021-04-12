<?php

// All models.
foreach (
    [
        'Model',
        'User',
        'Post',
        'Comment',
    ]
    as $model
) {
    require "models/{$model}.php";
}

include 'includes/new-form-intro.php';
include 'includes/helper.php';

// All controllers.
foreach (
    [
        '',
        'Registration',
        'Login',
        'Home',
        'Post',
        'Comment'
    ]
    as $controller
) {
    require "controllers/{$controller}Controller.php";
}

require "packages/Route.php";
require "router.php";