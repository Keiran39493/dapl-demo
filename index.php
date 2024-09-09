<?php
// Start the session to manage user login status
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the CSS file -->
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

            <?php
            // Check if the user is logged in (session variable is set)
            if (isset($_SESSION['user_id'])) {
                // Display a link to the profile and logout
                echo '<a href="dashboard.php">Profile</a>';
                echo '<a href="logout.php">Logout</a>';
            } else {
                // Display a login link if not logged in
                echo '<a href="login.php">Login</a>';
            }
            ?>
        </nav>
    </header>
    
    <div class="container">
    <main>
            <section class="intro">
                <h2>Welcome to the Digital Accessibility Prompt Library (DAPL)</h2>
                <p>This project focuses on creating a comprehensive prompt library using generative AI tools to solve digital accessibility issues, in alignment with WCAG 2.1 principles.</p>
                <p>Explore our prompt library to find solutions tailored to various accessibility challenges.</p>
            </section>
            <section class="links">
                <a href="library.html" class="button">Explore our library here!</a>
                <br>
                <br>
                <a href="manual.html" class="button">Try our User Manual here for assistance</a>
            </section>
        </main>
    </div>

    <footer>
        <p>&copy; 2024 Digital Accessibility Project. All Rights Reserved.</p>
    </footer>
</body>
</html>
