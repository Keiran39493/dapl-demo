<?php
session_start();
include('config.php');

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Handle form submissions for adding, editing, and deleting
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add new issue
    if (isset($_POST['add_issue'])) {
        $new_issue = trim($_POST['new_issue']);
        if (!empty($new_issue)) {
            $add_stmt = $conn->prepare("INSERT INTO accessibility_issues (issue_name) VALUES (?)");
            $add_stmt->bind_param("s", $new_issue);
            $add_stmt->execute();
            $add_stmt->close();
            $message = "New issue added!";
        }
    }

    // Edit issue
    if (isset($_POST['edit_issue'])) {
        $issue_id = $_POST['issue_id'];
        $issue_name = trim($_POST['issue_name']);
        if (!empty($issue_name)) {
            $edit_stmt = $conn->prepare("UPDATE accessibility_issues SET issue_name = ? WHERE issue_id = ?");
            $edit_stmt->bind_param("si", $issue_name, $issue_id);
            $edit_stmt->execute();
            $edit_stmt->close();
            $message = "Issue updated!";
        }
    }

    // Delete issue
    if (isset($_POST['delete_issue'])) {
        $issue_id = $_POST['issue_id'];
        $delete_stmt = $conn->prepare("DELETE FROM accessibility_issues WHERE issue_id = ?");
        $delete_stmt->bind_param("i", $issue_id);
        $delete_stmt->execute();
        $delete_stmt->close();
        $message = "Issue deleted!";
    }
}

// Fetch existing accessibility issues
$issues_stmt = $conn->prepare("SELECT issue_id, issue_name FROM accessibility_issues ORDER BY issue_name ASC");
$issues_stmt->execute();
$issues_result = $issues_stmt->get_result();
$issues_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Accessibility Issues</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include('header.php'); ?> <!-- Include the admin navigation -->

<div class="container">
    <h1>Manage Accessibility Issues</h1>

    <?php if (isset($message)): ?>
        <p class="success-message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <div class="issues-list">
        <h2>Existing Issues</h2>
        <ul>
            <?php while ($row = $issues_result->fetch_assoc()): ?>
                <li>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="issue_id" value="<?php echo $row['issue_id']; ?>">
                        <input type="text" name="issue_name" value="<?php echo htmlspecialchars($row['issue_name']); ?>">
                        <button type="submit" name="edit_issue" class="button">Edit</button>
                        <button type="submit" name="delete_issue" class="button delete-button" onclick="return confirm('Are you sure you want to delete this issue?');">Delete</button>
                    </form>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <div class="add-issue-form">
        <h2>Add New Issue</h2>
        <form method="POST">
            <input type="text" name="new_issue" placeholder="Enter new issue" required>
            <button type="submit" name="add_issue" class="button">Add Issue</button>
        </form>
    </div>
</div>

<footer>
    <p>&copy; 2024 Digital Accessibility Project. All rights reserved.</p>
</footer>

</body>
</html>
