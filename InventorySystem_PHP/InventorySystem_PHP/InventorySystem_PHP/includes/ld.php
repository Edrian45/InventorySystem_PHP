
<?php
// Database connection details
define('DB_HOST', 'localhost'); // Replace with your database host
define('DB_USER', 'root');      // Replace with your database username
define('DB_PASS', '');          // Replace with your database password
define('DB_NAME', 'your_database'); // Replace with your database name

// Create a connection
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Function to sanitize inputs
function remove_junk($string) {
    global $db;
    return $db->real_escape_string(htmlspecialchars(trim($string)));
}

// Session management
require_once('session.php'); // Make sure you have a session handling script
?>s