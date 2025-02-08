<?php
// Start output buffering and load dependencies
ob_start();
require_once('includes/load.php');

// Redirect to home if the user is already logged in
if ($session->isUserLoggedIn(true)) {
    redirect('home.php', false);
}

// Include the header
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Inventory Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url(https://www.atyourbusiness.com/blog/wp-content/uploads/2018/12/inventorytechniques.jpg);
      background-size: cover;
      background-repeat: no-repeat;
      height: 100vh;
    }

    .login-page {
      width: 100%;
      max-width: 400px;
      margin: 150px auto;
      background: rgba(255, 255, 255, 0.8);
      padding: 30px;
      border-radius: 70px 0px 70px 0px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .login-page img {
      width: 250px;
      height: auto;
      border-radius: 10%;
      margin-bottom: 20px;
    }

    .login-page h1 {
      font-size: 2rem;
      color: #007bff;
      font-family: fantacy;
    }

    .login-page h4 {
      font-size: 1.2rem;
      color: #555;
      font-family: monospace;
    }

    .btn-primary {
      width: 100%;
      padding: 12px;
    }

    .create-account-link {
      display: block;
      text-align: center;
      margin-top: 10px;
      color: #007bff;
      text-decoration: none;
    }

    .create-account-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="login-page">
      <div class="text-center">
        <img src="https://scontent.fdvo6-1.fna.fbcdn.net/v/t39.30808-6/471769555_1116203076825259_5913078955153600272_n.jpg?stp=cp6_dst-jpg_tt6&_nc_cat=102&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeH3s6F81p94EeWcQsHKMe7EM9l0Elr4zncz2XQSWvjOdwNtS0_5HSvY7LR8lLWYs-MkjNGAbwq4FJOBwVPmg7Iv&_nc_ohc=3XG6kHqdmf4Q7kNvgFmyOhl&_nc_zt=23&_nc_ht=scontent.fdvo6-1.fna&_nc_gid=Am8AgKy4Olch8hs009rghKD&oh=00_AYA3Xv2IclU1hd51EcFUTsSkT6wicfyTTyEl9RoTJR-B4A&oe=67967978" alt="Login Icon">
        <h1>LOGIN PANEL</h1>
        <h4>[INIES MINI MART] Inventory</h4>
      </div>

      <!-- Display Flash Messages -->
      <?php echo display_msg($msg); ?>

      <!-- Login Form -->
      <form method="post" action="auth.php">
        <div class="mb-3">
          <label for="username" class="form-label">Email</label>
          <input class="form-control" name="username" id="username" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">Login</button>
          <a href="login_v2.php" class="create-account-link">Create Account</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Include the footer
include_once('layouts/footer.php');
?>