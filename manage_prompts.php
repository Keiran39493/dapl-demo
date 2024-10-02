<?php
session_start();
include('config.php');

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Handle form submissions for adding, editing, updating, and deleting prompts
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add a new prompt
    if (isset($_POST['add_prompt'])) {
        $new_guideline = trim($_POST['new_guideline']);
        $new_problem = trim($_POST['new_problem']);
        $new_prompt_text = trim($_POST['new_prompt_text']);
        $new_ai_recommendation = trim($_POST['new_ai_recommendation']);
        $new_ai_link = trim($_POST['new_ai_link']);
        $new_ai_description = trim($_POST['new_ai_description']);

        if (!empty($new_guideline) && !empty($new_problem) && !empty($new_prompt_text) && !empty($new_ai_recommendation) && !empty($new_ai_link) && !empty($new_ai_description)) {
            $add_stmt = $conn->prepare("INSERT INTO prompts (guideline, problem, prompt_text, ai_recommendation, ai_link, ai_description) VALUES (?, ?, ?, ?, ?, ?)");
            $add_stmt->bind_param("ssssss", $new_guideline, $new_problem, $new_prompt_text, $new_ai_recommendation, $new_ai_link, $new_ai_description);
            $add_stmt->execute();
            $add_stmt->close();
            $message = "New prompt added!";
            $message_type = "success";
        } else {
            $message = "Please fill in all fields.";
            $message_type = "error";
        }
    }

    // Edit prompt
    if (isset($_POST['edit_prompt'])) {
        $prompt_id = $_POST['prompt_id'];
        $problem = trim($_POST['problem']);
        $prompt_text = trim($_POST['prompt_text']);
        $ai_recommendation = trim($_POST['ai_recommendation']);
        $guideline = trim($_POST['guideline']);
        $ai_link = trim($_POST['ai_link']);
        $ai_description = trim($_POST['ai_description']);

        if (!empty($problem) && !empty($prompt_text) && !empty($ai_recommendation) && !empty($guideline) && !empty($ai_link) && !empty($ai_description)) {
            $edit_stmt = $conn->prepare("UPDATE prompts SET problem = ?, prompt_text = ?, ai_recommendation = ?, guideline = ?, ai_link = ?, ai_description = ? WHERE id = ?");
            $edit_stmt->bind_param("ssssssi", $problem, $prompt_text, $ai_recommendation, $guideline, $ai_link, $ai_description, $prompt_id);
            $edit_stmt->execute();
            $edit_stmt->close();
            $message = "Prompt updated!";
            $message_type = "success";
        }
    }

    // Delete prompt
    if (isset($_POST['delete_prompt'])) {
        $prompt_id = $_POST['prompt_id'];
        $delete_stmt = $conn->prepare("DELETE FROM prompts WHERE id = ?");
        $delete_stmt->bind_param("i", $prompt_id);
        $delete_stmt->execute();
        $delete_stmt->close();
        $message = "Prompt deleted!";
        $message_type = "success";
    }
}

// Fetch existing prompts ordered by WCAG guideline (ascending)
$prompts_stmt = $conn->prepare("
    SELECT id, problem, prompt_text, ai_recommendation, guideline, ai_link, ai_description 
    FROM prompts 
    ORDER BY guideline ASC
");
$prompts_stmt->execute();
$prompts_result = $prompts_stmt->get_result();
$prompts_stmt->close();

// WCAG guidelines array (this would contain the description for each WCAG guideline)
$wcag_guidelines = [
    "1.1" => "Text Alternatives",
    "1.2" => "Time-based Media",
    "1.3" => "Adaptable",
    "1.4" => "Distinguishable",
    "2.1" => "Keyboard Accessible",
    "2.2" => "Enough Time",
    "2.3" => "Seizures and Physical Reactions",
    "2.4" => "Navigable",
    "2.5" => "Input Modalities",
    "3.1" => "Readable",
    "3.2" => "Predictable",
    "3.3" => "Input Assistance",
    "4.1" => "Compatible"
    // Add more WCAG guidelines if needed for future development
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Prompts</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: black;
            font-size: 24px;
            font-family: Arial, sans-serif;
            margin-bottom: 20px;
        }

        .form input[type="text"], .form textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .form button {
            padding: 10px;
            background-color: #00539CFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form button:hover {
            background-color: #003d80;
        }

        .back-link {
            display: block;
            margin-bottom: 20px;
            font-size: 16px;
            color: #00539CFF;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .button-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .button-container button {
            padding: 8px 12px;
            background-color: #00539CFF;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #003d80;
        }

        .edit-prompt-form {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .success-message {
            color: green;
            background-color: #e0f8e0;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }

        .error-message {
            color: red;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #00539CFF;
            color: white;
            text-align: center;
        }

        td {
            background-color: #f9f9f9;
        }

        td p {
            margin: 0;
            padding: 5px 0;
        }

        
        textarea {
            height: 100px;
        }

        
        .ai-recommendation-col {
            width: 10%; 
        }

        .actions-col {
            width: 15%; 
        }
    </style>
</head>
<body>

<?php include('header.php'); ?> 

<div class="container">
    <!-- Back Link -->
    <a href="admin_dashboard.php" class="back-link">&larr; Back to Dashboard</a>

    <h1>Manage Prompts</h1>

    <?php if (isset($message)): ?>
        <p class="<?php echo isset($message_type) && $message_type === 'success' ? 'success-message' : 'error-message'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php endif; ?>

    <!-- Table for displaying prompts -->
    <table>
        <thead>
            <tr>
                <th>WCAG Guideline</th>
                <th>Problem</th>
                <th>Prompt Text</th>
                <th class="ai-recommendation-col">AI Recommendation</th>
                <th>AI Link</th>
                <th>AI Description</th>
                <th class="actions-col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $prompts_result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php
                        $guideline_number = $row['guideline'];
                        echo htmlspecialchars($guideline_number) . " - " . htmlspecialchars($wcag_guidelines[$guideline_number] ?? "Unknown Guideline");
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['problem']); ?></td>
                    <td><?php echo htmlspecialchars($row['prompt_text']); ?></td>
                    <td class="ai-recommendation-col"><?php echo htmlspecialchars($row['ai_recommendation']); ?></td>
                    <td><?php echo htmlspecialchars($row['ai_link']); ?></td>
                    <td><?php echo htmlspecialchars($row['ai_description']); ?></td>
                    <td class="actions-col">
                        <div class="button-container">
                            <button type="button" onclick="toggleEditForm('<?php echo $row['id']; ?>')">Edit</button>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="prompt_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_prompt" onclick="return confirm('Are you sure you want to delete this prompt?');">Delete</button>
                            </form>
                        </div>

                        <!-- Edit Prompt Form (hidden by default) -->
                        <div id="edit-prompt-form-<?php echo $row['id']; ?>" class="edit-prompt-form">
                            <h3>Edit Prompt</h3>
                            <form method="POST">
                                <input type="hidden" name="prompt_id" value="<?php echo $row['id']; ?>">
                                <input type="text" name="guideline" placeholder="WCAG Guideline" value="<?php echo htmlspecialchars($row['guideline']); ?>" required>
                                <textarea name="problem" placeholder="Problem" required><?php echo htmlspecialchars($row['problem']); ?></textarea>
                                <textarea name="prompt_text" placeholder="Prompt Text" required><?php echo htmlspecialchars($row['prompt_text']); ?></textarea>
                                <input type="text" name="ai_recommendation" placeholder="AI Recommendation" value="<?php echo htmlspecialchars($row['ai_recommendation']); ?>" required>
                                <input type="text" name="ai_link" placeholder="AI Link" value="<?php echo htmlspecialchars($row['ai_link']); ?>" required>
                                <textarea name="ai_description" placeholder="AI Description" required><?php echo htmlspecialchars($row['ai_description']); ?></textarea>
                                <button type="submit" name="edit_prompt" class="update-button">Update Prompt</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>

            <!-- Row for adding new prompt -->
            <tr>
                <form method="POST">
                    <td>
                        <input type="text" name="new_guideline" placeholder="WCAG Guideline" required>
                    </td>
                    <td>
                        <textarea name="new_problem" placeholder="Problem" required></textarea>
                    </td>
                    <td>
                        <textarea name="new_prompt_text" placeholder="Prompt Text" required></textarea>
                    </td>
                    <td class="ai-recommendation-col">
                        <input type="text" name="new_ai_recommendation" placeholder="AI Recommendation" required>
                    </td>
                    <td>
                        <input type="text" name="new_ai_link" placeholder="AI Link" required>
                    </td>
                    <td>
                        <textarea name="new_ai_description" placeholder="AI Description" required></textarea>
                    </td>
                    <td class="actions-col">
                        <button type="submit" name="add_prompt" class="update-button">Add Prompt to Library</button>
                    </td>
                </form>
            </tr>

        </tbody>
    </table>
</div>

<footer>
    <p>&copy; 2024 Digital Accessibility Project. All rights reserved.</p>
</footer>

<script>
    function toggleEditForm(promptId) {
        const form = document.getElementById('edit-prompt-form-' + promptId);
        if (form.style.display === 'block') {
            form.style.display = 'none';  // Close the form if it's open
        } else {
            // Hide all forms first
            document.querySelectorAll('.edit-prompt-form').forEach(function (form) {
                form.style.display = 'none';
            });
            form.style.display = 'block';  // Open the clicked form
        }
    }
</script>

</body>
</html>
