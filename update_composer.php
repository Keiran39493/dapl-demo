<?php
// Path to Composer
$composer_path = 'C:/xampp/php/composer.phar';  // Modify the path if necessary

// Command to run Composer update
$command = "php $composer_path update";

// Execute the command
system($command, $output);

// Check if the update was successful
if ($output === 0) {
    echo "Composer update successful!";
} else {
    echo "Composer update failed!";
}
?>
