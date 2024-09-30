<?php
session_start();
include('config.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

// Fetch all feedback and ratings from the database
$stmt = $conn->prepare("
    SELECT f.name, f.email, f.message, u.username, 
           DATE_FORMAT(f.created_at, '%d/%m/%Y %H:%i') AS created_at, 
           f.rating 
    FROM feedback f 
    JOIN users u ON f.user_id = u.user_id 
    ORDER BY f.created_at DESC
");
$stmt->execute();
$result = $stmt->get_result();
$feedbacks = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Calculate the average rating
$averageRatingStmt = $conn->prepare("SELECT AVG(rating) as average_rating FROM feedback WHERE rating IS NOT NULL");
$averageRatingStmt->execute();
$averageRatingResult = $averageRatingStmt->get_result();
$averageRatingRow = $averageRatingResult->fetch_assoc();
$averageRating = round($averageRatingRow['average_rating'], 1);
$averageRatingStmt->close();

function displayStars($rating) {
    $fullStars = floor($rating);  // Round down to the closest whole number
    $emptyStars = 5 - $fullStars;

    $stars = str_repeat('★', $fullStars);
    $stars .= str_repeat('☆', $emptyStars);

    return $stars;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Feedback</title>
    <link rel="stylesheet" href="styles.css">
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

        h1 {
            color: black;
            font-size: 24px;
            font-family: Arial, sans-serif;
            margin-bottom: 20px;
        }

        .average-rating {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .stars {
            color: gold;
            font-size: 20px;
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

    <h1>User Feedback</h1>

    <div class="average-rating">
        <strong>Average Website Rating:</strong> <?= $averageRating ?> 
        <span class="stars"><?= displayStars($averageRating) ?></span>
    </div>

    <table class="user-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Rating</th>
                <th>Date Submitted</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feedbacks as $feedback): ?>
            <tr>
                <td><?= htmlspecialchars($feedback['username']) ?></td>
                <td><?= htmlspecialchars($feedback['name']) ?></td>
                <td><?= htmlspecialchars($feedback['email']) ?></td>
                <td><?= htmlspecialchars($feedback['message']) ?></td>
                <td><span class="stars"><?= displayStars($feedback['rating']) ?></span></td>
                <td><?= htmlspecialchars($feedback['created_at']) ?></td>
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
