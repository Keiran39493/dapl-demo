<?php
// Start the session to manage user login status
session_start();
include('config.php'); // Include the database connection

// Handle bookmark action with page refresh
if (isset($_POST['bookmark']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];  // Get user ID from session
    $prompt_id = $_POST['prompt_id'];

    // Check if the prompt is already bookmarked
    $check_stmt = $conn->prepare("SELECT * FROM bookmarks WHERE user_id = ? AND prompt_id = ?");
    $check_stmt->bind_param("ii", $user_id, $prompt_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows == 0) {
        // If not bookmarked, add bookmark
        $stmt = $conn->prepare("INSERT INTO bookmarks (user_id, prompt_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $prompt_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // If already bookmarked, remove bookmark
        $stmt = $conn->prepare("DELETE FROM bookmarks WHERE user_id = ? AND prompt_id = ?");
        $stmt->bind_param("ii", $user_id, $prompt_id);
        $stmt->execute();
        $stmt->close();
    }
    $check_stmt->close();

    // Redirect to avoid form resubmission and refresh the page
    header('Location: library.php');
    exit();
}

// Fetch prompts, ordering by WCAG guideline (ascending) and bookmarked prompts first
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$query = "
    SELECT p.*, b.id as bookmark_id 
    FROM prompts p 
    LEFT JOIN bookmarks b ON p.id = b.prompt_id AND b.user_id = ? 
    ORDER BY b.id IS NULL ASC, p.guideline ASC, p.id DESC
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
        /* Star Bookmark Styling */
        .star {
            font-size: 25px;  
            color: #ccc;      /* Default gray color */
            cursor: pointer;
            transition: color 0.2s, transform 0.2s;  /* Smooth transitions */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);  /* Light shadow for depth */
            margin-left: 20px;
        }

        .star.active {
            color: gold;
        }

       
        button.star {
            background: none;
            border: none;
            padding: 0;
            margin: 0;
        }

        /* Styling for filter buttons */
        .filter-buttons {
            margin-bottom: 25px;
            display: flex;
            flex-wrap: wrap; /* Ensures buttons wrap onto the next line if necessary */
            gap: 10px; 
        }

        .filter-buttons button {
            padding: 6px 15px;
            margin-right: 8px;
            background-color: #00539CFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .filter-buttons button:hover {
            background-color: #003d80;
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

        function filterPrompts(guideline) {
            const promptItems = document.querySelectorAll('.prompt-item');

            promptItems.forEach(function(item) {
                const itemGuideline = item.getAttribute('data-guideline');
                
                if (guideline === 'all') {
                    item.style.display = ""; // Show all prompts
                } else if (itemGuideline === guideline) {
                    item.style.display = ""; // Show only matching prompts
                } else {
                    item.style.display = "none"; // Hide non-matching prompts
                }
            });
        }
    </script>
</head>
<body>

<?php include('header.php'); ?>

    <div class="container">
        <main>
            <section class="library">
                <h2>Digital Accessibility Prompt Library</h2>
                <p><strong>Note:</strong> This library provides prompts to help address various digital accessibility challenges developers face. Clicking on any AI tool link (e.g., ChatGPT, Gemini, Copilot) will automatically copy the associated prompt to your clipboard and redirect you to the AI tool’s website, where you can use the prompt. Additionally, logged-in users can bookmark prompts for easy access later by clicking on the star icon next to each prompt.</p>
                <p>Below is a collection of prompts designed to help solve various accessibility issues:</p>

                <!-- Search Bar -->
                <input type="text" id="searchBar" onkeyup="searchPrompts()" placeholder="Search for problems..." class="search-bar">

                <!-- Filter Buttons -->
                <div class="filter-buttons">
                    <button onclick="filterPrompts('1.1')">WCAG 1.1: Text Alternatives</button>
                    <button onclick="filterPrompts('1.2')">WCAG 1.2: Time-Based Media</button>
                    <button onclick="filterPrompts('1.3')">WCAG 1.3: Adaptable</button>
                    <button onclick="filterPrompts('1.4')">WCAG 1.4: Distinguishable</button>
                    <button onclick="filterPrompts('2.1')">WCAG 2.1: Keyboard Accessible</button>
                    <button onclick="filterPrompts('2.2')">WCAG 2.2: Enough Time</button>
                    <button onclick="filterPrompts('2.3')">WCAG 2.3: Seizures and Physical Reactions</button>
                    <button onclick="filterPrompts('2.4')">WCAG 2.4: Navigable</button>
                    <button onclick="filterPrompts('2.5')">WCAG 2.5: Input Modalities</button> 
                    <button onclick="filterPrompts('3.1')">WCAG 3.1: Readable</button> 
                    <button onclick="filterPrompts('3.2')">WCAG 3.2: Predictable</button> 
                    <button onclick="filterPrompts('3.3')">WCAG 3.3: Input Assistance</button>
                    <button onclick="filterPrompts('4.1')">WCAG 4.1: Compatible</button> 
                    <button onclick="filterPrompts('all')">Show All Prompts</button>
                </div>

                <ul class="prompt-list" id="promptList">
                    <?php foreach ($prompts as $prompt): ?>
                    <li class="prompt-item" data-guideline="<?= htmlspecialchars($prompt['guideline']) ?>">
                        
                        <span style="font-weight: bold; font-size: 14px; color: #000;">
                            <strong>(WCAG <?= htmlspecialchars($prompt['guideline']) ?>: <?= htmlspecialchars(
                             $prompt['guideline'] == '1.1' ? 'Text Alternatives' : (
                             $prompt['guideline'] == '1.2' ? 'Time-Based Media' : (
                             $prompt['guideline'] == '1.3' ? 'Adaptable' : (
                             $prompt['guideline'] == '1.4' ? 'Distinguishable' : (
                             $prompt['guideline'] == '2.1' ? 'Keyboard Accessible' : (
                             $prompt['guideline'] == '2.2' ? 'Enough Time' : (
                             $prompt['guideline'] == '2.3' ? 'Seizures and Physical Reactions' : (
                             $prompt['guideline'] == '2.4' ? 'Navigable' : (
                             $prompt['guideline'] == '2.5' ? 'Input Modalities' : (
                             $prompt['guideline'] == '3.1' ? 'Readable' : (
                             $prompt['guideline'] == '3.2' ? 'Predictable' : (
                             $prompt['guideline'] == '3.3' ? 'Input Assistance' : (
                             $prompt['guideline'] == '4.1' ? 'Compatible' : ''
                             ))))))))))))) ?>)</strong>
                        </span>
                        <h3>Problem: <?= htmlspecialchars($prompt['problem']) ?> </h3>

                        <p id="prompt<?= $prompt['id'] ?>" data-prompt="<?= htmlspecialchars($prompt['prompt_text']) ?>">
                            <strong>Prompt:</strong> <?= htmlspecialchars($prompt['prompt_text']) ?>
                        </p>
                        <button onclick="copyPrompt('prompt<?= $prompt['id'] ?>')">Copy Prompt</button>

                        <!-- Bookmark icon with star style, only shown if the user is logged in -->
                        <?php if (isset($_SESSION['user_id'])): ?>
                        <form method="POST" action="library.php" style="display:inline;">
                            <input type="hidden" name="prompt_id" value="<?= $prompt['id'] ?>">
                            <button type="submit" name="bookmark" class="star" style="background:none;border:none;">
                                <i class="fas fa-star star <?= $prompt['bookmark_id'] ? 'active' : '' ?>"></i>
                            </button>
                        </form>
                        <?php endif; ?>

                        <div class="ai-suggestions">
                            <h4>Generative AI Suggestion:</h4>
                            <ul>
                                <li>
                                    <a href="<?= htmlspecialchars($prompt['ai_link']) ?>" target="_blank" onclick="handleLinkClick(event, 'prompt<?= $prompt['id'] ?>')">
                                        <?= htmlspecialchars($prompt['ai_recommendation']) ?>
                                    </a>
                                    <p><?= htmlspecialchars($prompt['ai_description']) ?></p> <!-- Display the AI description -->
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
