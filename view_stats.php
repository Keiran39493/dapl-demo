<?php
session_start();
include('config.php');

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch total users excluding admins
$total_users_stmt = $conn->prepare("SELECT COUNT(*) AS total_users FROM users WHERE role != 'admin'");
$total_users_stmt->execute();
$total_users_stmt->bind_result($total_users);
$total_users_stmt->fetch();
$total_users_stmt->close();

// Fetch most popular accessibility issues in descending order
$popular_issues_stmt = $conn->prepare("
    SELECT ai.issue_name, COUNT(ua.issue_id) AS issue_count
    FROM accessibility_issues ai
    LEFT JOIN user_accessibility ua ON ai.issue_id = ua.issue_id
    GROUP BY ai.issue_name
    ORDER BY issue_count DESC
");
$popular_issues_stmt->execute();
$popular_issues_result = $popular_issues_stmt->get_result();
$popular_issues_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Stats</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you're using a global stylesheet -->
</head>
<body>

<?php include('header.php'); ?> <!-- Include your header for navigation -->

<div class="container">
    <h1>Website Statistics</h1>

    <div class="stats-section">
        <p><strong>Users:</strong> <?php echo $total_users; ?></p>

        <h2>Most Popular Accessibility Issues</h2>
        <ul>
            <?php while ($row = $popular_issues_result->fetch_assoc()): ?>
                <li><?php echo htmlspecialchars($row['issue_name']) . " - " . $row['issue_count']; ?></li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>

<footer>
    <p>&copy; 2024 Digital Accessibility Project. All rights reserved.</p>
</footer>

</body>
</html>
