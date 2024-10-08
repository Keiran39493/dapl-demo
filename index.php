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
    
<?php include('header.php'); ?>
    
    <div class="container">
    <main>
            <section class="intro">
                <h2>Welcome to the Digital Accessibility Prompt Library (DAPL)</h2>
                <p>This website focuses on creating a comprehensive prompt library, leveraging generative AI tools to solve digital accessibility issues in alignment with WCAG 2.1 principles.</p>
                <p>Explore our prompt library to find solutions tailored to various accessibility challenges.</p>
            </section>
            <section class="links">
                <a href="library.php" class="button">Explore our Prompt Library here!</a>
                <br>
                <br>
                <a href="manual.php" class="button">Select our User Manual here for assistance</a>
            </section>
        </main>
    </div>

    <footer>
        <p>&copy; 2024 Digital Accessibility Project. All Rights Reserved.</p>
    </footer>
</body>
</html>
