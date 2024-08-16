<?php
session_start();

// Check if the user is logged in and is an admin
if (!(isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)) {
    header("Location: admin_login.php"); // Redirect if not an admin
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <?php include "../header.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="Admin.css">
</head>
<body>
    <?php include "Sidebar.php"; ?>

    <div class="height-100 bg-light">

    </div>
    
</body>
</html>