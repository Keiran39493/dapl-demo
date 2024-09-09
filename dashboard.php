<?php
session_start();
include('config.php');

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user information
$stmt = $conn->prepare("SELECT username, email FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();

// Fetch user accessibility issues
$issues_stmt = $conn->prepare("
    SELECT ai.issue_name 
    FROM accessibility_issues ai
    JOIN user_accessibility ua ON ai.issue_id = ua.issue_id
    WHERE ua.user_id = ?
");
$issues_stmt->bind_param("i", $user_id);
$issues_stmt->execute();
$issues_result = $issues_stmt->get_result();
$issues = [];
while ($row = $issues_result->fetch_assoc()) {
    $issues[] = $row['issue_name'];
}
$issues_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <a href="index.php">
        <img src="logo.png" alt="Digital Accessibility Project Logo" class="logo">
    </a>
    <nav>
        <a href="index.php">Home</a>
        <a href="library.php">Prompt Library</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="manual.php">User Manual</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="container">
    <h1 style="text-align: left;">Welcome to Your Dashboard, <?php echo htmlspecialchars($username); ?>!</h1>
    
    <div class="user-info">
        <h2>Your Information</h2>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Accessibility Issues:</strong> <?php echo implode(', ', array_map('htmlspecialchars', $issues)); ?></p>
    </div>

    <div class="links">
        <h2>Quick Links</h2>
        <ul>
            <li><a href="about.php">About Us</a></li>
            <li><a href="library.php">Your Library</a></li>
            <li><a href="contact.php">Contact Support</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>

<footer>
    <p>&copy; 2024 Your Website. All rights reserved.</p>
</footer>

</body>
</html>
