<?php
session_start();
require_once 'config.php';

// Only admins can access
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Validate the ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: Admin_page.php");
    exit();
}

$userId = intval($_GET['id']);

// Optional: Prevent admin from deleting themselves
if ($_SESSION['email'] === $conn->query("SELECT email FROM users WHERE id = $userId")->fetch_assoc()['email']) {
    $_SESSION['delete_error'] = "You cannot delete your own account.";
    header("Location: Admin_page.php");
    exit();
}

// Execute deletion
$conn->query("DELETE FROM users WHERE id = $userId");

// Redirect back
header("Location: Admin_page.php");
exit();
?>
