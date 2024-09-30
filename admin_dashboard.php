<?php
session_start();
include('config.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$user_id = $_SESSION['user_id'];

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
    header('Location: admin_dashboard.php');
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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <h1>Admin Dashboard</h1>

    <div class="admin-section">
        <h2>Manage Accessibility Issues</h2>
        <p>You can add, edit, and delete accessibility issues here.</p>
        <a href="manage_issues.php" class="admin-btn">Manage Accessibility Issues</a>
    </div>

    <div class="admin-section">
        <h2>View Website Stats</h2>
        <p>View the statistics of the website, including the number of users and popular accessibility issues.</p>
        <a href="view_stats.php" class="admin-btn">View Stats</a>
    </div>

    <div class="admin-section">
        <h2>Manage Users</h2>
        <p>View and manage registered users.</p>
        <a href="manage_users.php" class="admin-btn">Manage Users</a>
    </div>

    <!-- Feedback Section -->
    <div class="admin-section">
        <h2>User Feedback</h2>
        <p>View feedback left by users.</p>
        <a href="feedback.php" class="admin-btn">View Feedback</a>
    </div>

    <!-- Bookmarked Prompts Section -->
    <div class="admin-section">
        <h2>Your Bookmarked Prompts</h2>
        <?php if (!empty($bookmarked_prompts)): ?>
            <ul class="prompt-list">
                <?php foreach ($bookmarked_prompts as $prompt): ?>
                <li class="prompt-item">
                    <h3>Problem: <?= htmlspecialchars($prompt['problem']) ?></h3>
                    <p id="prompt<?= $prompt['id'] ?>" data-prompt="<?= htmlspecialchars($prompt['prompt_text']) ?>">
                        <strong>Prompt:</strong> <?= htmlspecialchars($prompt['prompt_text']) ?>
                    </p>
                    <button onclick="copyPrompt('prompt<?= $prompt['id'] ?>')">Copy Prompt</button>

                    <!-- Bookmark icon to toggle bookmark status -->
                    <form method="POST" id="bookmarkForm<?= $prompt['id'] ?>" action="admin_dashboard.php" style="display:inline;">
                        <input type="hidden" name="prompt_id" value="<?= $prompt['id'] ?>">
                        <input type="hidden" name="bookmark" value="toggle">
                        <button type="button" onclick="confirmToggleBookmark('bookmarkForm<?= $prompt['id'] ?>')" style="background:none;border:none;">
                            <i class="<?= $prompt['bookmark_id'] ? 'fas fa-star' : 'far fa-star' ?>" style="font-size: 24px; color: <?= $prompt['bookmark_id'] ? 'gold' : '#ccc' ?>"></i>
                        </button>
                    </form>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>You have no bookmarked prompts yet.</p>
        <?php endif; ?>
    </div>
</div>

<footer>
    <p>&copy; 2024 Digital Accessibility Project. All rights reserved.</p>
</footer>

</body>
</html>
