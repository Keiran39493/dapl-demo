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
    <style>
        header {
            background-color: #F1F1E9;
            color: white;
            padding: 20px;
            display: flex;
            text-align: left;
            margin-bottom: 20px;
            justify-content: space-between;
        }

        header .logo {
            display: block;
            margin-right: auto;
            max-width: 150px;
            height: auto;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #F1F1E9;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        nav {
            display: flex;
            gap: 15px;
        }

        nav a {
            color: black;
            padding: 10px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        nav a:hover {
            background-color: white;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #413932;
            text-align: center;
        }

        h2 {
            color: #00539CFF;
            margin-bottom: 15px;
            text-align: left;
        }

        .success-message {
            color: green;
            background-color: #dfd;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
        }

        .issues-list ul {
            list-style-type: none;
            padding: 0;
        }

        .issues-list li {
            background-color: #f9f9f9;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .issues-list input[type="text"] {
            width: 70%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .button, .delete-button {
            padding: 5px 10px;
            background-color: #00539CFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover, .delete-button:hover {
            background-color: #003d80;
        }

        .delete-button {
            background-color: red;
        }

        .delete-button:hover {
            background-color: darkred;
        }

        .add-issue-form input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
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

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
            border-radius: 0 0 8px 8px;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?> <!-- Include the admin navigation -->

<div class="container">
    <a href="admin_dashboard.php" class="back-link">&larr; Back to Dashboard</a> <!-- Back to Dashboard link -->

    <h1>Manage Accessibility Issues</h1>

    <?php if (isset($message)): ?>
        <p class="success-message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <div class="issues-list">
        <h2>Existing Issues</h2>
        <ul>
            <?php while ($row = $issues_result->fetch_assoc()): ?>
                <li>
                    <form method="POST">
                        <input type="hidden" name="issue_id" value="<?php echo $row['issue_id']; ?>">
                        <input type="text" name="issue_name" value="<?php echo htmlspecialchars($row['issue_name']); ?>">
                        <div class="issue-actions">
                            <button type="submit" name="edit_issue" class="button">Update</button>
                            <button type="submit" name="delete_issue" class="delete-button" onclick="return confirm('Are you sure you want to delete this issue?');">Delete</button>
                        </div>
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
