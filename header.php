<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Only start session if not already started
}
?>

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
        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            // Show Admin Dashboard link if the user is an admin
            if ($_SESSION['role'] === 'admin') {
                echo '<a href="admin_dashboard.php">Admin Dashboard</a>';
            } else {
                // Show Profile link for regular users
                echo '<a href="dashboard.php">Profile</a>';
            }
            // Show Logout link for all logged-in users
            echo '<a href="logout.php" onclick="return confirmLogout();">Logout</a>';
        } else {
            // Show Login link for guests
            echo '<a href="login.php">Login</a>';
        }
        ?>
    </nav>
</header>
