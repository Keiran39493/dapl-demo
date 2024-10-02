<?php
session_start();
include('config.php');

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Handle form submissions for adding, editing, and deleting accessibility issues
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

    // Edit issue description
    if (isset($_POST['edit_description'])) {
        $issue_id = $_POST['issue_id'];
        $description = trim($_POST['description']);
        if (!empty($description)) {
            $edit_stmt = $conn->prepare("UPDATE accessibility_issues SET description = ? WHERE issue_id = ?");
            $edit_stmt->bind_param("si", $description, $issue_id);
            $edit_stmt->execute();
            $edit_stmt->close();
            $message = "Issue description updated!";
            $message_type = "success"; // Mark this as a success message
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
$issues_stmt = $conn->prepare("SELECT issue_id, issue_name, description FROM accessibility_issues ORDER BY issue_name ASC");
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
    <style>
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

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

        .form input[type="text"], .form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .form button {
            padding: 10px;
            background-color: #00539CFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form button:hover {
            background-color: #003d80;
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

        .button-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .button-container button {
            padding: 8px 12px;
            background-color: #00539CFF;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #003d80;
        }

        .edit-description-form {
            display: none; /* Hidden by default */
            margin-top: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .issue-name {
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?> 

<div class="container">
    <!-- Back Link -->
    <a href="admin_dashboard.php" class="back-link">&larr; Back to Dashboard</a>

    <h1>Manage Accessibility Issues</h1>

    <?php if (isset($message)): ?>
        <p class="<?php echo isset($message_type) && $message_type === 'success' ? 'success-message' : 'error-message'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php endif; ?>

    <!-- Existing Issues List -->
    <ul class="issues-list">
        <?php while ($row = $issues_result->fetch_assoc()): ?>
            <li>
                <form method="POST">
                    <p class="issue-name">Issue Name: <?php echo htmlspecialchars($row['issue_name']); ?></p>
                    <p>Description: <?php echo htmlspecialchars($row['description'] ?? 'No description provided'); ?></p>
                    <div class="button-container">
                        <button type="button" onclick="toggleEditForm('<?php echo $row['issue_id']; ?>')">Edit Description</button>
                        <button type="submit" name="delete_issue" onclick="return confirm('Are you sure you want to delete this issue?');">Delete Issue</button>
                    </div>

                    <!-- Edit Description Form (will appear under the issue) -->
                    <div id="edit-description-form-<?php echo $row['issue_id']; ?>" class="edit-description-form">
                        <h3>Edit Issue Description</h3>
                        <input type="hidden" name="issue_id" value="<?php echo $row['issue_id']; ?>">
                        <textarea name="description" placeholder="Edit issue description" required><?php echo htmlspecialchars($row['description']); ?></textarea>
                        <button type="submit" name="edit_description" class="update-button">Update Description</button>
                    </div>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>

    <!-- Add New Issue -->
    <div class="form">
        <h3>Add New Issue</h3>
        <form method="POST">
            <input type="text" name="new_issue" placeholder="Enter new issue" required>
            <button type="submit" name="add_issue">Add Issue</button>
        </form>
    </div>
</div>

<footer>
    <p>&copy; 2024 Digital Accessibility Project. All rights reserved.</p>
</footer>

<script>
    function toggleEditForm(issueId) {
        const form = document.getElementById('edit-description-form-' + issueId);
        if (form.style.display === 'block') {
            form.style.display = 'none';  // Close the form if it's open
        } else {
            // Hide all forms first
            document.querySelectorAll('.edit-description-form').forEach(function (form) {
                form.style.display = 'none';
            });
            form.style.display = 'block';  // Open the clicked form
        }
    }
</script>

</body>
</html>
