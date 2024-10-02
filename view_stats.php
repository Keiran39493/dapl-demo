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
$generalUserQuery = "SELECT COUNT(*) as total_general_users FROM users WHERE role = 'general_user'";
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

// Query to count prompts per WCAG guideline and order by prompt count (lowest to highest)
$wcagGuidelineQuery = "
    SELECT guideline, COUNT(*) as prompt_count
    FROM prompts
    GROUP BY guideline
    ORDER BY guideline ASC"; // Order by prompt count in ascending order
$wcagGuidelineResult = $conn->query($wcagGuidelineQuery);

// Query to count how many times an AI has been chosen, ordered alphabetically
$aiRecommendationQuery = "
    SELECT ai_recommendation, COUNT(*) as recommendation_count
    FROM prompts
    GROUP BY ai_recommendation
    ORDER BY ai_recommendation ASC"; // Order by AI recommendation alphabetically
$aiRecommendationResult = $conn->query($aiRecommendationQuery);

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
    <a href="admin_dashboard.php" class="back-link">&larr; Back to Dashboard</a> 

    <h1>Website Statistics</h1>

    <!-- Note explaining the importance of these statistics -->
    <p class="note">
        Understanding website statistics and accessibility interests is crucial for administrators. These insights enable our website developers to identify areas where content needs to be populated and highlight the accessibility issues that other developers struggle with the most. By focusing on these aspects, the website can be continuously improved to meet both developer and user needs effectively.
    </p>

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
    <h2>User Accessibility Interests Breakdown</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Accessibility Issue</th>
                <th>Number of Users Interested</th>
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

    <!-- Third Table: Prompts per WCAG Guideline -->
    <h2>Prompts per WCAG Guideline</h2>
    <table class="table">
        <thead>
            <tr>
                <th>WCAG Guideline</th>
                <th>Number of Prompts</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $wcagGuidelineResult->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['guideline']) ?></td>
                <td><?= htmlspecialchars($row['prompt_count']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Fourth Table: AI Recommendations -->
    <h2>AI Recommendations Breakdown</h2>
    <table class="table">
        <thead>
            <tr>
                <th>AI Recommendation</th>
                <th>Number of Times Recommended</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $aiRecommendationResult->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['ai_recommendation']) ?></td>
                <td><?= htmlspecialchars($row['recommendation_count']) ?></td>
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
