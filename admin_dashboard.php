<?php
session_start();
include('config.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

// Admin-specific content goes here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you already have a styles.css -->
    <style>
        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #00539CFF;
            text-align: center;
            margin-bottom: 20px;
        }

        .admin-section {
            margin-bottom: 30px;
        }

        .admin-section h2 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.5em;
        }

        .admin-section p {
            font-size: 1.1em;
            color: #555;
        }

        .admin-btn {
            padding: 10px 20px;
            background-color: #00539CFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .admin-btn:hover {
            background-color: #003d80;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="admin-container">
    <h1>Admin Dashboard</h1>

    <div class="admin-section">
        <h2>Manage Accessibility Issues</h2>
        <p>You can add, edit, and delete accessibility issues here.</p>
        <a href="manage_issues.php" class="admin-btn">Manage Accessibility Issues</a>
    </div>

    <div class="admin-section">
        <h2>View Website Stats</h2>
        <p>View the statistics of the website, including the number of users and popular accessibility issues.</p>
        <a href="view_stats.php" class="admin-btn">View Stats</a>
    </div>
</div>

<footer>
    <p>&copy; 2024 Digital Accessibility Project. All rights reserved.</p>
</footer>

</body>
</html>
