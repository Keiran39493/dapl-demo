<?php
session_start();
include('config.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

// Handle deletion of users
if (isset($_POST['delete_user'])) {
    $user_id_to_delete = $_POST['user_id'];

    // Start a transaction to ensure atomicity
    $conn->begin_transaction();

    try {
        // Delete associated records from the feedback table
        $stmt = $conn->prepare("DELETE FROM feedback WHERE user_id = ?");
        $stmt->bind_param("i", $user_id_to_delete);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting feedback: " . $stmt->error);
        }
        $stmt->close();

        // Delete associated records from the user_accessibility table
        $stmt = $conn->prepare("DELETE FROM user_accessibility WHERE user_id = ?");
        $stmt->bind_param("i", $user_id_to_delete);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting accessibility data: " . $stmt->error);
        }
        $stmt->close();

        // Finally, delete the user from the users table
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id_to_delete);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting user: " . $stmt->error);
        }
        $stmt->close();

        // Commit the transaction
        $conn->commit();

        // Set a success message
        $_SESSION['message'] = "User deleted successfully.";
    } catch (Exception $e) {
        // Rollback transaction in case of any error
        $conn->rollback();
        $_SESSION['message'] = "Error deleting user: " . $e->getMessage();
    }
}

// Fetch all non-admin users along with their accessibility issues and role, ordered by date_created
$stmt = $conn->prepare("
    SELECT u.user_id, u.username, u.email, u.role, 
           GROUP_CONCAT(ai.issue_name SEPARATOR ', ') AS accessibility_issues, 
           DATE_FORMAT(u.date_created, '%d/%m/%Y') AS date_created
    FROM users u
    LEFT JOIN user_accessibility ua ON u.user_id = ua.user_id
    LEFT JOIN accessibility_issues ai ON ua.issue_id = ai.issue_id
    WHERE u.role != 'admin'
    GROUP BY u.user_id
    ORDER BY u.date_created DESC
");
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
$total_users = count($users);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function confirmDelete(userId) {
            if (confirm("Are you sure you want to delete this user? This action cannot be undone.")) {
                document.getElementById('deleteForm' + userId).submit();
            }
        }
    </script>
    <style>
        .user-table {
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

        .user-table thead {
            background-color: #00539CFF;
            color: white;
        }

        .user-table th, .user-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        .user-table tr:hover {
            background-color: #f1f1f1;
        }

        .user-table th {
            text-align: center;
            background-color: #00539CFF;
        }

        .user-table td {
            text-align: center;
        }

        .success-message {
            color: green;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .delete-btn {
            background: none;
            border: none;
            color: red;
            cursor: pointer;
            font-size: 18px;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .delete-btn:hover {
            background-color: #ffcccc;
        }

        .total-users {
            font-weight: bold;
            font-size: 20px;
            margin-top: 20px;
        }

        h1 {
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

    <h1>Manage Users</h1>

    <?php if (isset($_SESSION['message'])): ?>
        <p class="success-message"><?= htmlspecialchars($_SESSION['message']) ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <p class="total-users">Total Users: <?= htmlspecialchars($total_users) ?></p> <!-- Display total number of users before the table -->

    <table class="user-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th> <!-- New Role column -->
                <th>Accessibility Issues</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['username'] ?? '') ?></td>
                <td><?= htmlspecialchars($user['email'] ?? '') ?></td>
                <td><?= htmlspecialchars($user['role'] ?? '') ?></td> <!-- Display the role -->
                <td><?= htmlspecialchars($user['accessibility_issues'] ?? 'N/A') ?></td> <!-- Handle potential null values -->
                <td><?= htmlspecialchars($user['date_created'] ?? '') ?></td>
                <td>
                    <!-- Delete User Form -->
                    <form id="deleteForm<?= htmlspecialchars($user['user_id']) ?>" method="POST" action="manage_users.php" style="display:inline;">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                        <button type="submit" name="delete_user" class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<footer>
    <p>&copy; 2024 Digital Accessibility Project. All rights reserved.</p>
</footer>

</body>
</html>
