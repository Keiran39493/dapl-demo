<?php
session_start();
include('config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, display the message with full site styling
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Us</title>
        <link rel="stylesheet" href="styles.css"> <!-- Link to the CSS file -->
    </head>
    <body>
    
    <?php include('header.php'); ?>
    
    <div class="container">
        <main>
            <section class="contact">
                <h2>Contact Us</h2>
                <p>You must be logged in to leave feedback. <a href="login.php">Login here</a> or <a href="register.php">Register</a>.</p>
            </section>
        </main>
    </div>
    
    <footer>
        <p>&copy; 2024 Digital Accessibility Project. All Rights Reserved.</p>
    </footer>
    
    </body>
    </html>
    <?php
    exit;
}

// Fetch user data (name and email)
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, email FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();

$feedbackSubmitted = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = trim($_POST['message']);
    $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;

    if (!empty($message) && $rating > 0) {
        $stmt = $conn->prepare("INSERT INTO feedback (user_id, name, email, message, rating) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssi", $user_id, $username, $email, $message, $rating);
        if ($stmt->execute()) {
            $feedbackSubmitted = true;
        }
        $stmt->close();
    } else {
        $error = "Please enter a message and select a rating.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css">
    <style>
.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.star');
            let rating = 0;

            stars.forEach((star, index) => {
                // Handle click to set rating
                star.addEventListener('click', function () {
                    rating = index + 1;
                    stars.forEach((s, i) => {
                        if (i < rating) {
                            s.classList.add('active'); 
                        } else {
                            s.classList.remove('active');
                        }
                    });
                    document.getElementById('rating').value = rating;
                });

                // Hover effect to preview rating
                star.addEventListener('mouseover', function () {
                    stars.forEach((s, i) => {
                        if (i <= index) {
                            s.classList.add('hovered');
                        } else {
                            s.classList.remove('hovered');
                        }
                    });
                });

                // Remove hover effect
                star.addEventListener('mouseout', function () {
                    stars.forEach((s) => {
                        s.classList.remove('hovered');
                    });
                });
            });
        });
    </script>
</head>
<body>

<?php include('header.php'); ?>

<div class="container">
    <main>
        <section class="contact">
            <h2>Contact Us</h2>

            <?php if ($feedbackSubmitted): ?>
                <p class="thank-you-message">Thank you for your feedback!</p>
                <a href="index.php" class="back-to-home">← Back to Home</a>
            <?php else: ?>
                <form method="POST">
                    <label for="message">Your Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>

                    <div class="rating-stars-container">
                        <h2>Rate Us:</h2>
                        <div class="rating-stars" aria-label="Star Rating">
                            <span class="star" role="radio" aria-checked="false" aria-label="1 star">★</span>
                            <span class="star" role="radio" aria-checked="false" aria-label="2 stars">★</span>
                            <span class="star" role="radio" aria-checked="false" aria-label="3 stars">★</span>
                            <span class="star" role="radio" aria-checked="false" aria-label="4 stars">★</span>
                            <span class="star" role="radio" aria-checked="false" aria-label="5 stars">★</span>
                        </div>
                    </div>

                    <input type="hidden" id="rating" name="rating" value="0"> <!-- Hidden input for storing rating value -->
                    <?php if (isset($error)): ?>
                        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                    <?php endif; ?>
                    <button type="submit">Submit Message</button>
                </form>
            <?php endif; ?>
        </section>
    </main>
</div>

<footer>
    <p>&copy; 2024 Digital Accessibility Project. All Rights Reserved.</p>
</footer>

</body>
</html>
