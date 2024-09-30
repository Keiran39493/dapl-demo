<?php
// Start the session to manage user login status
session_start();
include('config.php'); // Include the database connection

// Handle bookmark action
if (isset($_POST['bookmark']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];  // Assuming you're using sessions
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
        // Optionally: remove the bookmark if it exists (toggle functionality)
        $stmt = $conn->prepare("DELETE FROM bookmarks WHERE user_id = ? AND prompt_id = ?");
        $stmt->bind_param("ii", $user_id, $prompt_id);
        $stmt->execute();
        $stmt->close();
    }
    $check_stmt->close();

    // Redirect to avoid form resubmission
    header('Location: library.php');
    exit();
}

// Fetch prompts, ordering bookmarked ones first
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$query = "
    SELECT p.*, b.id as bookmark_id 
    FROM prompts p 
    LEFT JOIN bookmarks b ON p.id = b.prompt_id AND b.user_id = ? 
    ORDER BY b.id DESC, p.id DESC
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$prompts = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prompt Library - Digital Accessibility</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Star Bookmark Styling - Same as Contact Form */
        .star {
            font-size: 25px;  /* Larger star size */
            color: #ccc;      /* Default gray color */
            cursor: pointer;
            transition: color 0.2s, transform 0.2s;  /* Smooth transitions */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);  /* Light shadow for depth */
        }

        .star:hover, .star.active {
            color: gold;  /* Turn gold when active or hovered */
            transform: scale(1.2);  /* Slight zoom effect */
        }

        /* Remove button styling to ensure only the star is styled */
        button.star {
            background: none;
            border: none;
            padding: 0;
            margin: 0;
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

        function handleLinkClick(event, id) {
            event.preventDefault();
            copyPrompt(id);
            window.open(event.target.href, '_blank');
        }

        function searchPrompts() {
            let input = document.getElementById('searchBar').value.toLowerCase();
            let promptItems = document.querySelectorAll('.prompt-item');
            promptItems.forEach(function(item) {
                let problemDescription = item.querySelector('h3').textContent.toLowerCase();
                if (problemDescription.includes(input)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        }

        function toggleStar(star) {
            star.classList.toggle('active');  // Toggles between active and inactive states
        }
    </script>
</head>
<body>

<?php include('header.php'); ?>

    <div class="container">
        <main>
            <section class="library">
                <h2>Digital Accessibility Prompt Library</h2>
                <p><strong>Note:</strong> This library provides AI-generated prompts to help address various digital accessibility issues. Clicking on any AI tool link (e.g., ChatGPT) will automatically copy the associated prompt to your clipboard for use. Additionally, logged-in users can bookmark prompts for easy access later by clicking on the star icon next to each prompt.</p>
                <p>Below is a collection of prompts designed to help solve various accessibility issues:</p>

                <!-- Search Bar -->
                <input type="text" id="searchBar" onkeyup="searchPrompts()" placeholder="Search for problems..." class="search-bar">

                <ul class="prompt-list" id="promptList">
                    <?php foreach ($prompts as $prompt): ?>
                    <li class="prompt-item">
                        <h3>Problem: <?= htmlspecialchars($prompt['problem']) ?></h3>
                        <p id="prompt<?= $prompt['id'] ?>" data-prompt="<?= htmlspecialchars($prompt['prompt_text']) ?>">
                            <strong>Prompt:</strong> <?= htmlspecialchars($prompt['prompt_text']) ?>
                        </p>
                        <button onclick="copyPrompt('prompt<?= $prompt['id'] ?>')">Copy Prompt</button>

                        <!-- Bookmark icon with star style, only shown if the user is logged in -->
                        <?php if (isset($_SESSION['user_id'])): ?>
                        <form method="POST" action="library.php" style="display:inline;">
                            <input type="hidden" name="prompt_id" value="<?= $prompt['id'] ?>">
                            <button type="submit" name="bookmark" class="star" onclick="toggleStar(this)" style="background:none;border:none;">
                                <i class="fas fa-star star <?= $prompt['bookmark_id'] ? 'active' : '' ?>"></i>
                            </button>
                        </form>
                        <?php endif; ?>

                        <div class="ai-suggestions">
                            <h4>Generative AI Suggestions:</h4>
                            <ul>
                                <li>
                                    <a href="https://chat.openai.com/" target="_blank" onclick="handleLinkClick(event, 'prompt<?= $prompt['id'] ?>')">ChatGPT</a> - <strong>Recommended</strong>
                                    <p>ChatGPT is recommended for generating detailed and contextually accurate descriptions due to its advanced language understanding capabilities.</p>
                                </li>
                                <li>
                                    <a href="https://gemini.google.com/" target="_blank" onclick="handleLinkClick(event, 'prompt<?= $prompt['id'] ?>')">Gemini</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 Digital Accessibility Project. All Rights Reserved.</p>
    </footer>
</body>
</html>
