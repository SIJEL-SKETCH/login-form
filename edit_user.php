<?php
// Start session and include database configuration
session_start();
require_once 'config.php';

// ✅ Admin-only access control
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// ✅ Validate the incoming user ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: Admin_portal.php"); // Adjusted redirect
    exit();
}

$userId = intval($_GET['id']);

// ✅ Fetch the user using a prepared statement
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    $stmt->close();
    header("Location: Admin_portal.php");
    exit();
}

$user = $result->fetch_assoc();
$stmt->close();

// ✅ Handle form submission
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $updateStmt = $conn->prepare("UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?");
    $updateStmt->bind_param("sssi", $name, $email, $role, $userId);
    $updateStmt->execute();
    $updateStmt->close();

    header("Location: Admin_portal.php"); // Adjusted redirect
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="stylesheet1.css">
    <style>
        /* === Edit User Page Styling === */
        body {
            background: #f4f4f4;
            font-family: 'Poppins', sans-serif;
        }

        .form-box {
            max-width: 500px;
            margin: 60px auto;
            background: #ffffff;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .form-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            background: #f9f9f9;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            background: #7494ec;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-weight: 500;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #6884d3;
        }

        button.cancel {
            background: #999;
        }

        button.cancel:hover {
            background: #777;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Edit User</h2>
        <form method="post">
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            <select name="role" required>
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
            <button type="submit" name="update">Update</button>
            <button type="button" class="cancel" onclick="window.location.href='Admin_portal.php'">Cancel</button>
        </form>
    </div>
</body>
</html>
