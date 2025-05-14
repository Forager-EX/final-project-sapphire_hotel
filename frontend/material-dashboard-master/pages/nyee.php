<?php
// PHP logic to handle form submission
$host = "localhost";
$username = "root";
$password = ""; // default XAMPP password
$database = "sapphire_hotel";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $password = $conn->real_escape_string($_POST['password']);
    // $password = password_hash($password, PASSWORD_DEFAULT); // Optional hashing

    $check = $conn->query("SELECT * FROM admin WHERE email='$email'");
    if ($check->num_rows > 0) {
        $error = "Email already registered.";
    } else {
        $sql = "INSERT INTO admin (name, email, password, mobile) VALUES ('$name', '$email', '$password', '$mobile')";
        if ($conn->query($sql) === TRUE) {
            $success = "Registration successful!";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Registration - Sapphire Hotel</title>
  <link rel="stylesheet" href="../assets/css/material-dashboard.css" />
</head>
<body class="bg-gray-200">
  <main class="main-content mt-0">
    <div class="container my-5">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-12 mx-auto">
          <div class="card">
            <div class="card-header bg-gradient-dark text-white text-center py-3">
              <h4>Admin Registration</h4>
            </div>
            <div class="card-body">
              <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
              <?php elseif ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php endif; ?>

              <form method="POST" action="">
                <div class="mb-3">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" required />
                </div>
                <div class="mb-3">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" required />
                </div>
                <div class="mb-3">
                  <label>Mobile</label>
                  <input type="text" name="mobile" class="form-control" required />
                </div>
                <div class="mb-3">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" required />
                </div>
                <button type="submit" class="btn btn-dark w-100">Register</button>
              </form>

              <p class="text-center mt-3">
                Already have an account? <a href="sign-in.php">Sign in</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
