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

<?php include('header.php'); ?>


<div class="container">
    <h1 style="text-align: left;">Welcome to Your Dashboard, <?php echo htmlspecialchars($username); ?>!</h1>
    
    <div class="user-info">
        <h2>Your Information</h2>
        <p style="font-size: 18px;"><strong>Username:</strong> <?php echo htmlspecialchars($username); ?> 
            <a href="editprofile.php?type=username" class="edit-button">Edit</a></p>
        <p style="font-size: 18px;"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?> 
            <a href="editprofile.php?type=email" class="edit-button">Edit</a></p>
        <p style="font-size: 18px;"><strong>Accessibility Issues:</strong> <?php echo implode(', ', array_map('htmlspecialchars', $issues)); ?> 
            <a href="editprofile.php?type=issues" class="edit-button">Edit</a></p>
    </div>

    <div class="links">
        <h2>Quick Links</h2>
        <ul>
            <li><a href="about.php">About Us</a></li>
            <li><a href="library.php">Your Library</a></li>
            <li><a href="contact.php">Contact Support</a></li>
            <li><a href="logout.php" onclick="return confirmLogout();">Logout</a></li>
        </ul>
    </div>
</div>

<script>
function confirmLogout() {
    return confirm("Are you sure you want to logout?");
}
</script>

<footer>
    <p>&copy; 2024 Your Website. All rights reserved.</p>
</footer>

</body>
</html>
