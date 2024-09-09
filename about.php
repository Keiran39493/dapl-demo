<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="styles.css"> 
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
            // Dynamic login/logout link based on session
            if (isset($_SESSION['user_id'])) {
                echo '<a href="dashboard.php">Profile</a>';
                echo '<a href="logout.php">Logout</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
        </nav>
    </header>
    
    <div class="container">
        <main>
            <section class="about">
                <h2>About the Digital Accessibility Prompt Library</h2>
                <p>The Digital Accessibility Prompt Library is a project aimed at creating a collection of AI-generated prompts to solve accessibility issues in digital content. By adhering to WCAG 2.1 principles, we aim to make the web more inclusive for everyone. Our team consists of experts in web development, accessibility, and AI technologies, all working together to build this resource.</p>
                <br>
                <h3>Meet the Team</h3>
                <p>Matthew ADLER – 10526753 | Bachelor of Information Technology</p>
                <p>Keiran MOORES – 10537063 | Bachelor of Computer Science, Software Engineering Major</p>
                <p>GD SANJAYA – 10618344 | Bachelor of Computer Science, Cyber Security Major</p>
                <p>Connor MCKAY – 10551972 | Bachelor of Computer Science, Cyber Security Major</p>
                <p>Nikola OMDURMAN – 10571472 | Bachelor of Computer Science, Software Engineering Major</p>
            </section>
        </main>
    </div>

    <footer>
        <p>&copy; 2024 Digital Accessibility Project. All Rights Reserved.</p>
    </footer>
</body>
</html>
