<?php
session_start();
include('config.php');

$error = ""; // Initialize an empty error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Move nav links to the right */
        nav {
            display: flex;
            justify-content: flex-end;
            margin-right: 20px; /* Adjust margin to the right */
        }

        nav a {
            text-decoration: none;
            margin-left: 15px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            color: #333;
        }

        nav a:hover {
            background-color: #00539CFF;
            color: white;
        }

        .login-form {
            max-width: 400px; /* Limit the width of the form */
            margin: 0 auto; /* Center the form */
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-form input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #00539CFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .login-form input[type="submit"]:hover {
            background-color: #003d80;
        }
    </style>
</head>
<body>

<header>
    <a href="index.php">
        <img src="logo.png" alt="Your Website Logo" class="logo">
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
    <div class="login-form">
        <h2>Login</h2>

        <!-- Display the error message if login fails -->
        <?php if ($error): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <input type="submit" value="Login" class="button">
        </form>
        <p>Don't have an account? <a href="register.php">Register Here.</a></p>
    </div>
</div>

<footer>
    <p>&copy; 2024 Digital Accessibility Project. All rights reserved.</p>
</footer>

</body>
</html>
