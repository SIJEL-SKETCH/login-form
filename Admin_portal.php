<!-- login_register\Admin_portal.php -->
<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['email']) || $_SESSION['email'] == '' || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Fetch all users
$users = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
     <link rel="stylesheet" href="stylesheet1.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        a.action {
            margin-right: 10px;
            text-decoration: none;
            color: #7494ec;
            font-weight: bold;
        }
        a.action:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="box">
    <h1>Welcome, <span><?= htmlspecialchars($_SESSION['name']) ?></span></h1>
    <p>This is the <span>admin</span> dashboard</p>
    <button onclick="window.location.href='logout.php'">Logout</button>

    <h2>User List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($user = $users->fetch_assoc()): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <a class="action" href="edit_user.php?id=<?= $user['id'] ?>">Edit</a>
                    <a class="action" href="delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
