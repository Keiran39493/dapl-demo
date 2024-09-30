<?php
session_start();
include('config.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

// Query to count total developers
$developerQuery = "SELECT COUNT(*) as total_developers FROM users WHERE role = 'developer'";
$developerResult = $conn->query($developerQuery);
$developerRow = $developerResult->fetch_assoc();
$totalDevelopers = $developerRow['total_developers'];

// Query to count total general users
$generalUserQuery = "SELECT COUNT(*) as total_general_users FROM users WHERE role = 'general user'";
$generalUserResult = $conn->query($generalUserQuery);
$generalUserRow = $generalUserResult->fetch_assoc();
$totalGeneralUsers = $generalUserRow['total_general_users'];

// Query to count total admins
$adminQuery = "SELECT COUNT(*) as total_admins FROM users WHERE role = 'admin'";
$adminResult = $conn->query($adminQuery);
$adminRow = $adminResult->fetch_assoc();
$totalAdmins = $adminRow['total_admins'];

// Query to count total prompts
$promptQuery = "SELECT COUNT(*) as total_prompts FROM prompts";
$promptResult = $conn->query($promptQuery);
$promptRow = $promptResult->fetch_assoc();
$totalPrompts = $promptRow['total_prompts'];

// Query to get the count of users for each accessibility issue
$issueQuery = "
    SELECT ai.issue_name, COUNT(ua.user_id) as user_count
    FROM accessibility_issues ai
    LEFT JOIN user_accessibility ua ON ai.issue_id = ua.issue_id
    GROUP BY ai.issue_name
    ORDER BY user_count DESC";
$issueResult = $conn->query($issueQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Stats</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
            background-color: #f9f9f9;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #00539CFF;
            color: white;
        }

        .table th, .table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        .table th {
            text-align: center;
            background-color: #00539CFF;
        }

        h1, h2 {
            color: black;
            font-size: 24px;
            font-family: Arial, sans-serif;
            margin-bottom: 20px;
        }

        .back-link {
            display: block;
            margin-bottom: 20px;
            font-size: 16px;
            color: #00539CFF;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="container">
    <a href="admin_dashboard.php" class="back-link">&larr; Back to Dashboard</a> <!-- Back to Dashboard link -->

    <h1>Website Statistics</h1>

    <!-- First Table: Total Users, Admins, and Prompts -->
    <table class="table">
        <thead>
            <tr>
                <th>Stat Name</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Admins</td>
                <td><?= $totalAdmins ?></td>
            </tr>
            <tr>
                <td>Total Developers</td>
                <td><?= $totalDevelopers ?></td>
            </tr>
            <tr>
                <td>Total General Users</td>
                <td><?= $totalGeneralUsers ?></td>
            </tr>
            <tr>
                <td>Total Prompts</td>
                <td><?= $totalPrompts ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Second Table: User Accessibility Issues -->
    <h2>User Accessibility Issues Breakdown</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Accessibility Issue</th>
                <th>Number of Users</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $issueResult->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['issue_name']) ?></td>
                <td><?= htmlspecialchars($row['user_count']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<footer>
    <p>&copy; 2024 Digital Accessibility Project. All rights reserved.</p>
</footer>

</body>
</html>
