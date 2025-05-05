<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hotel Login</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-image: url('img/login bg.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      margin: 0;
      padding: 0;
      display: flex;
      height: 100vh;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.95);
      padding: 40px 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 15px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .logo-wrapper {
      margin-bottom: 10px;
    }

    .login-logo {
      width: 180px;
      display: block;
      margin: 0 auto;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 10px;
    }

    input[type="text"],
    input[type="password"] {
      width: 90%;
      padding: 12px 15px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    button {
      width: 90%;
      padding: 12px;
      margin-top: 10px;
      background-color: #0066cc;
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #005bb5;
    }

    .footer-link {
      margin-top: 15px;
      font-size: 14px;
    }

    .footer-link a {
      color: #0066cc;
      text-decoration: none;
    }

    .footer-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="logo-wrapper">
      <img src="img/logo.jpg" alt="GrandView Hotel Logo" class="login-logo" />
    </div>

    <!-- FORM STARTS HERE -->
    <?php
if (isset($_GET['error'])) {
    if ($_GET['error'] === "wrongpassword") {
        echo "<p style='color:red;'>Incorrect password.</p>";
    } elseif ($_GET['error'] === "usernotfound") {
        echo "<p style='color:red;'>Email not found.</p>";
    }
}
?>

    <form action="login_process.php" method="POST">
  <input type="text" name="username" placeholder="Email" required />
  <input type="password" name="password" placeholder="Password" required />
  <button type="submit">Login</button>
</form>

    <!-- FORM ENDS HERE -->

    <div class="footer-link">
      Don't have an account? <a href="register.php">Register here</a>
    </div>
  </div>

</body>
</html>
