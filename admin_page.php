<!-- login_register\admin_page.php -->
 
<?php
session_start();

// ✅ Allow only logged-in admins
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <!-- ✅ FIXED: Correct attribute order in link tag -->
     <link rel="stylesheet" href="stylesheet1.css">
</head>

<body style="background: #fff;">
    <div class="box">
        <!-- ✅ FIXED: Invalid <hi> tag → changed to <h1> -->
        <h1>Welcome, <span><?= htmlspecialchars($_SESSION['name']) ?></span></h1>
        
        <!-- ✅ FIXED: Case consistency + tag properly closed -->
        <p>This is an <span>admin</span> page.</p>
        
        <button onclick="window.location.href='logout.php'">Logout</button>
    </div>
     <div>
        <button onclick="window.location.href='Admin_portal.php'">
        Registered Users
        </button>
    </div>
</body>
</html>
