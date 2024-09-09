<?php
// Start the session to manage user login status
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Manual - Digital Accessibility Prompt Library</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <a href="index.php">
            <img src="logo.png" alt="Digital Accessibility Project Logo" class="logo">
        </a>
        <h1>User Manual</h1>
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
                echo '<a href="profile.php">Profile</a>';
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
            <section class="manual-intro">
                <h2>Introduction</h2>
                <p>Welcome to the User Manual for the Digital Accessibility Prompt Library. This guide is designed to help you navigate and effectively use the resources provided in this library.</p>
            </section>

            <section class="manual-content">
                <h2>How to Use the Digital Accessibility Prompt Library</h2>
                <p>The Digital Accessibility Prompt Library is organized into different sections, each targeting specific accessibility issues. Here’s how to get started:</p>
                <ol>
                    <li>Navigate to the <strong><a href="library.php">Prompt Library</a></strong> by clicking on the "Prompt Library" link in the navigation menu.</li>
                    <li>Browse through the list of common accessibility problems. Each problem is accompanied by a prompt that can be used with generative AI tools.</li>
                    <li>To use a prompt:
                        <ul>
                            <li><strong>Copy the Prompt:</strong> Click the "Copy Prompt" button next to it. The prompt will be automatically copied to your clipboard.</li>
                        </ul>
                    </li>
                    <li>You can then paste this prompt into your chosen AI tool, such as ChatGPT or Gemini, or use the opened search tab to find solutions or suggestions tailored to your specific needs.</li>
                </ol>
                <p>If you need additional assistance with a prompt or how to implement the generated suggestions, feel free to refer to the examples and best practices section below.</p>
            </section>

            <section class="manual-examples">
                <h2>Examples and Best Practices</h2>
                <p>Here are some examples of how to effectively use the prompts in the library:</p>
                <h3>Example 1: Describing an Image</h3>
                <p><strong>Scenario:</strong> You have an image on your website of a person using a laptop in a park, and you need a detailed description for accessibility purposes.</p>
                <p><strong>Prompt:</strong> "Describe an image of a person using a laptop in a park. The description should be detailed and cover the surroundings as well."</p>
                <p><strong>Best Practice:</strong> Ensure that the description not only covers the main subject (the person using the laptop) but also the context (e.g., the park, the weather, other people or objects in the vicinity). This provides a richer experience for users relying on screen readers.</p>

                <h3>Example 2: Captioning a Video</h3>
                <p><strong>Scenario:</strong> You need to add captions to a video where a professor explains the basics of quantum physics.</p>
                <p><strong>Prompt:</strong> "Generate detailed captions for a video where a professor explains the basics of quantum physics in a classroom setting."</p>
                <p><strong>Best Practice:</strong> Focus on clarity and conciseness in the captions. Ensure that all spoken words are captured accurately, including important non-verbal cues like pauses or emphatic gestures that enhance understanding.</p>
            </section>

            <section class="manual-support">
                <h2>Getting Support</h2>
                <p>If you encounter any issues while using the Digital Accessibility Prompt Library or have suggestions for improvement, our support team is here to help.</p>
                <p><strong>Contact Options:</strong></p>
                <ul>
                    <li>Visit our <a href="contact.php">Contact Us</a> page to send a direct message through our online form.</li>
                </ul>
                <p>We strive to respond to all inquiries within 24 hours. Additionally, you can check out our FAQ section (coming soon) for quick answers to common questions.</p>
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 Digital Accessibility Project. All Rights Reserved.</p>
    </footer>
</body>
</html>
