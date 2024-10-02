<?php
// Database credentials
$db_host = 'localhost';  // or your DB host if different
$db_user = 'root';       // your DB user
$db_password = '';       // your DB password
$db_name = 'your_database_name'; // your DB name

// Set the path for backup file
$backup_dir = 'C:/xampp/htdocs/backups/'; // Ensure this directory exists
if (!file_exists($backup_dir)) {
    mkdir($backup_dir, 0777, true); // Create the backups directory if it doesn't exist
}

$backup_file = $backup_dir . $db_name . '-backup-' . date("Y-m-d-H-i-s") . '.sql';

// Command to execute mysqldump
$command = "C:/xampp/mysql/bin/mysqldump --user=$db_user --password=$db_password --host=$db_host $db_name > $backup_file";

// Execute the command
system($command, $output);

// Check if the backup was successful
if ($output === 0) {
    echo "Backup successful! File saved to: " . $backup_file;
} else {
    echo "Backup failed!";
}
?>
