<!Doctype html>

<html lang="en">
<head>
    <title></title>
    <base href="/">
    <link rel="stylesheet" href="css/style.css"/>
</head>

<body>
<div class="container">

    <form method ="post" action="<?= route('login') ?>">
        <h1>Login Page</h1>
        <div class="form-group">
            <label>E-mail</label>
            <input type="text" class="form-control <?php if (isset($errors['email'])) {
                echo 'input-error';
            }; ?>" name="email" value="<?= $fields['email'] ?? '' ?>"/>
            <small><?= $errors['email'] ?? '' ?></small>
            <br>
            <br>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control <?php if (isset($errors['password'])) {
                echo 'input-error';
            }; ?>" name="password"><small><?= $errors['password'] ?? '' ?></small><br><br>
        </div>

        <button type="submit" class="btn">Login</button>
        <p>Not yet a member? <a href="<?= route('register') ?>">Register</a></p>
    </form>
</div>
</body>
</html>


