<!Doctype html>
<html>
<head>
    <title></title>

    <base href="/">
    <link rel="stylesheet" href="css/style.css"/>
</head>

<body>
<div class="container">

    <?php if ($error_response): ?>
        <div>
            <strong>ERROR!</strong>
            <p>
                <?= $error_response ?>
            </p>
        </div>
    <?php endif ?>

    <?php if ($success_response): ?>
        <div>
            <strong>SUCCESS!</strong>
            <p>
                <?= $success_response ?>
            </p>
        </div>
    <?php endif ?>

    <form method="POST" action="<?= route('register') ?>">
        <h1>Register Form</h1>
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control <?php if (isset($errors['name'])) {
                echo 'input-error';
            }; ?>" value="<?= $fields['name'] ?? '' ?>"
                   name="name"><small><?= $errors['name'] ?? '' ?></small><br><br>
        </div>

        <div class="form-group">
            <label>E-mail</label>
            <input type="text" class="form-control <?php if (isset($errors['email'])) {
                echo 'input-error';
            }; ?>" value="<?= $fields['email'] ?? '' ?>"
                   name="email"><small><?= $errors['email'] ?? '' ?></small><br><br>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control <?php if (isset($errors['password'])) {
                echo 'input-error';
            }; ?>" value="" name="password"><small><?= $errors['password'] ?? '' ?></small>
            <br><br>
        </div>

        <button type="submit" class="btn">Register!</button>
        <p>Already have an account? <a href="<?= route('login') ?>">Sign in</a></p>

    </form>
</div>
</body>
</html>

