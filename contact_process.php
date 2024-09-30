<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $rating = $_POST['rating'];

        // Insert the feedback into the database
        $stmt = $conn->prepare("INSERT INTO feedback (user_id, name, email, message, rating) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssi", $user_id, $name, $email, $message, $rating);
        $stmt->execute();
        $stmt->close();

        // Redirect to a thank you page or back to the contact form with a success message
        $_SESSION['message'] = "Thank you for your feedback!";
        header("Location: contact.php");
        exit;
    } else {
        // Handle the case where the user is not logged in
        $_SESSION['error'] = "You must be logged in to submit feedback.";
        header("Location: login.php");
        exit;
    }
}
?>
