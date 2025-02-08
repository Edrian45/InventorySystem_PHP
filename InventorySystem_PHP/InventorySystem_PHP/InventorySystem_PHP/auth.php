<?php
// Include dependencies
include_once('includes/load.php');

// Check for required fields
$req_fields = array('username', 'password');
validate_fields($req_fields);

// Sanitize input
$username = isset($_POST['username']) ? remove_junk($_POST['username']) : '';
$password = isset($_POST['password']) ? remove_junk($_POST['password']) : '';

if (empty($errors)) {
    // Authenticate user
    $user = authenticate_v2($username, $password);

    if ($user) {
        // Create session with user ID
        $session->login($user['id']);

        // Update last login time
        updateLastLogIn($user['id']);

        // Redirect based on user level
        $user_level = $user['user_level'];
        $welcome_msg = "Hello " . $user['username'] . ", Welcome to Inies Mini Mart-Invintory Management System.";

        if ($user_level === '1') {
            $session->msg("s", $welcome_msg);
            redirect('admin.php', false);
        } elseif ($user_level === '2') {
            $session->msg("s", $welcome_msg);
            redirect('home.php', false);
        } else {
            $session->msg("s", $welcome_msg);
            redirect('home.php', false);
        }
    } else {
        // Invalid credentials
        $session->msg("d", "Sorry, Username/Password incorrect.");
        redirect('index.php', false);
    }
} else {
    // Validation errors
    $session->msg("d", implode(', ', $errors));
    redirect('login_v2.php', false);
}
?>