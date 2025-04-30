<?php
session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeform = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewpor" content="width=device-width, initial-scale=1.0">
    <title>Full-stack Login & Register form with User & Admin page | codehal</title>
    <link rel="stylesheet" href="stylesheet1.css"/>
</head>

<body>

<div class="container">
    <div class="form-box <?= isActiveform('login', $activeform); ?>" id="login-form">
        <form action="login_register.php" method="post">
            <h2>Login</h2>
            <?= showError($errors['login']); ?>
            <input type="email" name="email" placeholder="name" required>
            <input type="password" name="password" placeholder="password" required>
            <button type="submit" name="Login">Login</button>
            <p>Don't have account? <a href="#" onclick="shawForm('Register-form')">Register</a></p>
            
        </form>
    </div>

    <div class="form-box <?= isActiveform('register', $activeform); ?>" id="Register-form">
        <form action="login_register.php" method="post">
            <h2>Register</h2>
            <?= showError($errors['register']); ?>
            <input type="text" name="name" placeholder="name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="password" required>
            <select name="role" require> 
                   <option value="">--Select Role--</option>
                   <option value="user">User</option>
                  <option value="admin">Admin</option>
            </select>
            <button type="submit" name="register">Register</button>
            <p>Already have account? <a href="#" onclick="shawForm('login-form')">Login</a></p>
            
        </form>
    </div>
</div>
<script src="script.js"></script>
</body>

</html>