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

<?php include('header.php'); ?>

<div class="container">
    <main>
        <!-- Introduction -->
        <section class="manual-intro">
            <h2>Welcome to the Digital Accessibility Prompt Library</h2>
            <p>Use this guide to navigate the Prompt Library and enhance the accessibility of your digital products. Whether you’re a developer, content creator, or accessibility advocate, this manual will help you make the most of our AI-generated prompts designed in alignment with WCAG 2.1 principles.</p>
        </section>

        <!-- How to Use the Library -->
        <section class="manual-content">
            <h2>How to Navigate the Prompt Library</h2>
            <ol>
                <li><strong>Access the Library:</strong> Go to the <a href="library.php">Prompt Library</a> via the navigation menu.</li>
                <li><strong>Browse Categories:</strong> Explore accessibility challenges such as image descriptions, video captions, and more.</li>
                <li><strong>Copy a Prompt:</strong> Click on the "Copy Prompt" button next to a prompt to copy it to your clipboard.</li>
                <li><strong>Use AI Tools:</strong> Paste the prompt into AI tools like ChatGPT or Gemini to generate accessibility solutions.</li>
                <li><strong>Additional Resources:</strong> Explore integrated guides to better understand how accessibility standards apply to your project.</li>
                <br>
            </ol>
        </section>

        <!-- Practical Examples & Best Practices -->
        <section class="manual-examples">
            <h2>Practical Examples & Best Practices</h2>

            <!-- Example 1 -->
            <div class="example-box">
                <h3>1. Describing Images for Screen Readers</h3>
                <p><strong>Scenario:</strong> A webpage includes an image of a student studying at a desk.</p>
                <p><strong>Prompt Example:</strong> "Provide a detailed description of an image showing a student studying at a desk with books and a laptop."</p>
                <p><strong>Best Practice:</strong> Ensure descriptions include both the subject and surrounding context for clarity.</p>
            </div>

            <!-- Example 2 -->
            <div class="example-box">
                <h3>2. Captioning a Video</h3>
                <p><strong>Scenario:</strong> Adding captions to a physics video tutorial where a teacher explains a concept.</p>
                <p><strong>Prompt Example:</strong> "Generate captions for a video where a teacher explains a concept in physics. Include both spoken words and key gestures."</p>
                <p><strong>Best Practice:</strong> Include non-verbal cues like pauses or gestures to enhance comprehension.</p>
            </div>

            <!-- Example 3 -->
            <div class="example-box">
                <h3>3. Generating Alt Text for Complex Charts</h3>
                <p><strong>Scenario:</strong> You have a complex chart showing data trends and need appropriate alt text.</p>
                <p><strong>Prompt Example:</strong> "Generate a detailed description for a chart illustrating quarterly sales growth across four regions."</p>
                <p><strong>Best Practice:</strong> Describe key data points, patterns, and outliers to ensure users can grasp essential insights.</p>
                <br>
            </div>
        </section>

        <!-- Additional Resources & Support -->
        <section class="manual-support">
            <h2>Additional Resources & Support</h2>
            <ul>
                <li><a href="contact.php">Contact Us:</a> Submit support requests or feedback via our contact form.</li>
                <li>FAQ (coming soon): Answers to common questions about using the library and implementing accessibility practices.</li>
            </ul>
        </section>

        <!-- Best Practices -->
        <section class="manual-best-practices">
            <h2>Best Practices for Accessibility</h2>
            <ul>
                <li><strong>Ensure Text Clarity:</strong> Use simple, clear language in your alt texts and prompts.</li>
                <li><strong>User Experience Focus:</strong> Design with the needs of users with various disabilities in mind.</li>
                <li><strong>Regular Testing:</strong> Test your website’s accessibility frequently using tools like screen readers.</li>
            </ul>
            <p>By following these practices, you can ensure a more accessible web experience for all users.</p>
        </section>
    </main>
</div>

<footer>
    <p>&copy; 2024 Digital Accessibility Project. All Rights Reserved.</p>
</footer>

</body>
</html>
