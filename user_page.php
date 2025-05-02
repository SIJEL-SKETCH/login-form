<!-- \login_register\user_page.php -->
<?php
session_start();

// ✅ FIXED: Correct syntax for checking session variable
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <!-- ✅ FIXED: Correct rel attribute -->
    <link rel="stylesheet" href="stylesheet1.css">
</head>

<body style="background: #fff;">
    <div class="box">
        <!-- ✅ FIXED: Changed <hi> to <h1>, added htmlspecialchars for security -->
        <h1>Welcome, <span><?= htmlspecialchars($_SESSION['name']) ?></span></h1>

        <!-- ✅ FIXED: Correct HTML tag casing -->
        <p>This is a <span>user</span> page.</p>

        <button onclick="window.location.href='logout.php'">Logout</button>
    </div>
   
</body>
</html>