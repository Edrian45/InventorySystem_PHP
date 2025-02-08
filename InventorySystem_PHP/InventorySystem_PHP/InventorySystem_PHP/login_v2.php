<?php 
// Start output buffering
ob_start();

// Include necessary files
require_once('includes/load.php');

// Ensure session and database are initialized
if (!isset($session)) {
    die("Session not initialized.");
}
if (!isset($db)) {
    die("Database connection not established.");
}

// Redirect if the user is already logged in
if ($session->isUserLoggedIn(true)) {
    redirect('index.php', false);
}

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate form inputs
    $username = isset($_POST['username']) ? remove_junk($_POST['username']) : '';
    $email = isset($_POST['email']) ? remove_junk($_POST['email']) : '';
    $password = isset($_POST['password']) ? remove_junk($_POST['password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? remove_junk($_POST['confirm_password']) : '';

    // Check if fields are empty
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $session->msg("d", "All fields are required.");
        redirect('register.php', false);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $session->msg("d", "Invalid email address.");
        redirect('register.php', false);
    } elseif ($password !== $confirm_password) {
        $session->msg("d", "Passwords do not match.");
        redirect('register.php', false);
    } else {
        // Hash password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Use prepared statements to prevent SQL injection
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        if ($stmt = $db->prepare($query)) {
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                $session->msg("s", "Account created successfully. You can now log in.");
                $stmt->close();
                redirect('index.php', false);
            } else {
                $session->msg("d", "Registration failed: " . $stmt->error);
            }

            $stmt->close();
        } else {
            $session->msg("d", "Database error: " . $db->error);
        }

        redirect('register.php', false);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            background-size: cover;
            background-repeat: no-repeat;
            background-image: url(https://www.atyourbusiness.com/blog/wp-content/uploads/2018/12/inventorytechniques.jpg);
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .signup-container {
            padding: 20px;
            width: 350px;
            background: rgba(255, 255, 255, 0.9);
            text-align: center;
            border-radius: 8px;
            backdrop-filter: blur(5px);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .footer-text {
            margin-top: 10px;
            font-size: 0.9rem;
        }

        .footer-text a {
            color: #007bff;
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h1>Create Account</h1>
        <p>Join us and start your journey!</p>
        <?php echo display_msg($msg); ?>
        <form method="post" action="register.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Create a password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="btn">Sign up</button>
        </form>
        <div class="footer-text">
            Already have an account? <a href="index.php">Login here</a>
        </div>
    </div>
</body>
</html>