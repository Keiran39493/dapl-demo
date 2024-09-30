<?php
session_start();
include('config.php');

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user information and role
$stmt = $conn->prepare("SELECT username, email, role FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $role);
$stmt->fetch();
$stmt->close();

// Check if the user has the correct role (regular user or developer)
$allowed_roles = ['general user', 'developer']; // Add your allowed roles here
if (!in_array($role, $allowed_roles)) {
    // Redirect to an unauthorized page or an error page
    header("Location: index.php");
    exit;
}

// Fetch user accessibility issues
$issues_stmt = $conn->prepare("
    SELECT ai.issue_name 
    FROM accessibility_issues ai
    JOIN user_accessibility ua ON ai.issue_id = ua.issue_id
    WHERE ua.user_id = ?
");
$issues_stmt->bind_param("i", $user_id);
$issues_stmt->execute();
$issues_result = $issues_stmt->get_result();
$issues = [];
while ($row = $issues_result->fetch_assoc()) {
    $issues[] = $row['issue_name'];
}
$issues_stmt->close();

// Handle bookmark action (Toggle bookmark)
if (isset($_POST['bookmark']) && isset($_POST['prompt_id'])) {
    $prompt_id = $_POST['prompt_id'];

    // Check if the prompt is already bookmarked
    $check_stmt = $conn->prepare("SELECT * FROM bookmarks WHERE user_id = ? AND prompt_id = ?");
    $check_stmt->bind_param("ii", $user_id, $prompt_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows == 0) {
        // Insert bookmark into the database
        $stmt = $conn->prepare("INSERT INTO bookmarks (user_id, prompt_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $prompt_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Remove the bookmark
        $stmt = $conn->prepare("DELETE FROM bookmarks WHERE user_id = ? AND prompt_id = ?");
        $stmt->bind_param("ii", $user_id, $prompt_id);
        $stmt->execute();
        $stmt->close();
    }
    $check_stmt->close();

    // Redirect to avoid form resubmission
    header('Location: dashboard.php');
    exit();
}

// Fetch bookmarked prompts
$bookmarks_stmt = $conn->prepare("
    SELECT p.id, p.problem, p.prompt_text, b.id as bookmark_id 
    FROM prompts p
    JOIN bookmarks b ON p.id = b.prompt_id
    WHERE b.user_id = ?
");
$bookmarks_stmt->bind_param("i", $user_id);
$bookmarks_stmt->execute();
$bookmarks_result = $bookmarks_stmt->get_result();
$bookmarked_prompts = [];
while ($row = $bookmarks_result->fetch_assoc()) {
    $bookmarked_prompts[] = $row;
}
$bookmarks_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .container {
            width: 80%;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 28px;
            color: #00539CFF;
            margin-bottom: 20px;
            text-align: left;
        }

        .user-info, .bookmarked-prompts, .links {
            margin-bottom: 30px;
        }

        h2 {
            color: #00539CFF;
            margin-bottom: 15px;
            font-size: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .prompt-list {
            list-style-type: none;
            padding: 0;
        }

        .prompt-item {
            background-color: #f9f9f9;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .prompt-item h3 {
            margin: 0;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .prompt-item h3 .bookmark-btn {
            margin-left: 10px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .prompt-item h3 .bookmark-btn i {
            font-size: 24px;
            color: #ccc;
        }

        .prompt-item h3 .bookmark-btn i.bookmarked {
            color: gold;
        }

        .prompt-item p {
            margin: 5px 0;
        }

        .prompt-actions {
            margin-top: 10px;
        }

        .prompt-item button {
            padding: 5px 15px;
            background-color: #00539CFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 150px; /* Fixed width for uniformity */
        }

        .prompt-item button:hover {
            background-color: #003d80;
        }

        ul {
            margin: 10px;
            padding: 10px;
        }

    </style>
    <script>
        function copyPrompt(id) {
            const textElement = document.getElementById(id);
            const textToCopy = textElement.dataset.prompt;
            navigator.clipboard.writeText(textToCopy).then(() => {
                alert("Prompt copied to clipboard!");
            }).catch(err => {
                console.error("Could not copy text: ", err);
            });
        }

        function confirmToggleBookmark(formId) {
            if (confirm("Are you sure you want to remove this bookmark?")) {
                document.getElementById(formId).submit();
            }
        }
    </script>
</head>
<body>

<?php include('header.php'); ?>

<div class="container">
    <h1>Welcome to Your Dashboard, <?php echo htmlspecialchars($username); ?>!</h1>
    
    <div class="user-info">
        <h2>Your Information</h2>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?> 
            <a href="editprofile.php?type=username" class="edit-button">Update</a></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?> 
            <a href="editprofile.php?type=email" class="edit-button">Update</a></p>
        <p><strong>Accessibility Issues Interested in:</strong> <?php echo implode(', ', array_map('htmlspecialchars', $issues)); ?> 
            <a href="editprofile.php?type=issues" class="edit-button">Update</a></p>
    </div>

    <!-- Bookmarked Prompts Section -->
    <div class="bookmarked-prompts">
        <h2>Your Bookmarked Prompts</h2>
        <?php if (!empty($bookmarked_prompts)): ?>
            <ul class="prompt-list">
                <?php foreach ($bookmarked_prompts as $prompt): ?>
                <li class="prompt-item">
                    <div>
                        <h3>Problem: <?= htmlspecialchars($prompt['problem']) ?>
                            <form method="POST" id="bookmarkForm<?= $prompt['id'] ?>" action="dashboard.php" style="display:inline;">
                                <input type="hidden" name="prompt_id" value="<?= $prompt['id'] ?>">
                                <input type="hidden" name="bookmark" value="toggle">
                                <button type="button" class="bookmark-btn" onclick="confirmToggleBookmark('bookmarkForm<?= $prompt['id'] ?>')">
                                    <i class="fas fa-star <?= $prompt['bookmark_id'] ? 'bookmarked' : '' ?>"></i>
                                </button>
                            </form>
                        </h3>
                        <p id="prompt<?= $prompt['id'] ?>" data-prompt="<?= htmlspecialchars($prompt['prompt_text']) ?>">
                            <strong>Prompt:</strong> <?= htmlspecialchars($prompt['prompt_text']) ?>
                        </p>
                    </div>
                    <div class="prompt-actions">
                        <button onclick="copyPrompt('prompt<?= $prompt['id'] ?>')">Copy Prompt</button>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>You have no bookmarked prompts yet.</p>
        <?php endif; ?>
    </div>

    <div class="links">
        <h2>Quick Links</h2>
        <ul>
            <li><a href="about.php">About Us</a></li>
            <li><a href="library.php">Your Library</a></li>
            <li><a href="contact.php">Contact Support</a></li>
            <li><a href="logout.php" onclick="return confirmLogout();">Logout</a></li>
        </ul>
    </div>
</div>

<script>
function confirmLogout() {
    return confirm("Are you sure you want to logout?");
}
</script>

<footer>
    <p>&copy; 2024 Your Website. All rights reserved.</p>
</footer>

</body>
</html>
