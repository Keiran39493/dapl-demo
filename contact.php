<?php
// Start the session to manage user login status
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

<?php include('header.php'); ?>
    
    <div class="container">
        <main>
            <section class="contact">
                <h2>Contact Us</h2>
                <p>If you have any questions, feel free to reach out to our team using the contact information below.</p>
                <!-- Original contact form functionality remains here -->
                <form action="contact_process.php" method="POST">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required><br><br>

                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" required><br><br>

                    <label for="message">Your Message:</label>
                    <textarea id="message" name="message" required></textarea><br><br>

                    <input type="submit" value="Send Message">
                </form>
            </section>
        </main>
    </div>

    <footer>
        <p>&copy; 2024 Digital Accessibility Project. All Rights Reserved.</p>
    </footer>
</body>
</html>
