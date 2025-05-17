<?php
// Connect to your database
$host = "localhost";
$username = "root";
$password = ""; // default in XAMPP
$database = "sapphire_hotel";

$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $password = $conn->real_escape_string($_POST['password']);

    // Optional: Hash the password
    // $password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $conn->query("SELECT * FROM admin WHERE email='$email'");
    if ($check->num_rows > 0) {
        echo "<script>alert('Email already registered.'); window.history.back();</script>";
    } else {
        // Insert into database
        $sql = "INSERT INTO admin (name, email, password, mobile) VALUES ('$name', '$email', '$password', '$mobile')";
        if ($conn->query($sql) === TRUE) {
          echo "<script> alert('Registration successful!'); window.location.href = '/final-project-sapphire_hotel/admin_login.php';
</script>";

        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="./assets/img/apple-icon.png"
    />
    <link rel="icon" type="image/png" href="./assets/img/logos/logo.jpg" />
    <title>Sapphire Hotel Admin</title>
    <!-- Fonts and icons -->
    <link
      rel="stylesheet"
      type="text/css"
      href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900"
    />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script
      src="https://kit.fontawesome.com/42d5adcbca.js"
      crossorigin="anonymous"
    ></script>
    <!-- Material Icons -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0"
    />
    <!-- CSS Files -->
    <link
      id="pagestyle"
      href="./assets/css/material-dashboard.css?v=3.2.0"
      rel="stylesheet"
    />
  </head>

  <body class="bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
      <div class="row">
        <div class="col-12">
          <!-- Navbar -->
          <!-- End Navbar -->
        </div>
      </div>
    </div>
    <main class="main-content mt-0">
      <div
        class="page-header align-items-start min-vh-100"
        style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');"
      >
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
          <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
              <div class="card z-index-0 fadeIn3 fadeInBottom">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">
                      Sign Up
                    </h4>
                  </div>
                </div>
                <div class="card-body">
                  <form method="POST" action="">
                    <div class="mb-3">
                      <label>Name</label>
                      <div class="input-group input-group-outline my-3">
                        <input
                          type="text"
                          name="name"
                          class="form-control"
                          required
                          style="border-radius: 10px; border: 1px solid gray; background-color: #f0f0f0;"
                        />
                      </div>
                    </div>

                    <div class="mb-3">
                      <label>Email</label>
                      <div class="input-group input-group-outline my-3">
                        <input
                          type="email"
                          name="email"
                          class="form-control"
                          required
                          style="border-radius: 10px; border: 1px solid gray; background-color: #f0f0f0;"
                        />
                      </div>
                    </div>

                    <div class="mb-3">
                      <label>Mobile</label>
                      <div class="input-group input-group-outline my-3">
                        <input
                          type="text"
                          name="mobile"
                          class="form-control"
                          required
                          style="border-radius: 10px; border: 1px solid gray; background-color: #f0f0f0;"
                        />
                      </div>
                    </div>

                    <div class="mb-3">
                      <label>Password</label>
                      <div class="input-group input-group-outline my-3">
                        <input
                          type="password"
                          name="password"
                          class="form-control"
                          required
                          style="border-radius: 10px; border: 1px solid gray; background-color: #f0f0f0;"
                        />
                      </div>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">Register</button>
                    <p class="mt-4 text-sm text-center">
                      Already have an account?
                      <a href="../admin_login.php" class="text-primary text-gradient font-weight-bold">Sign in</a>
                    </p>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer position-absolute bottom-2 py-2 w-100">
          <div class="container">
            <div class="row align-items-center justify-content-lg-between">
              <div class="col-12 col-md-6 my-auto">
                <div class="copyright text-center text-sm text-white text-lg-start">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made <i class="fa fa-heart" aria-hidden="true"></i> by
                  <a class="font-weight-bold text-white" target="_blank">Sapphire Hotel</a>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                  <li class="nav-item">
                    <a class="nav-link text-white" target="_blank">Sapphire Hotel</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" target="_blank">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" target="_blank">Blog</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link pe-0 text-white" target="_blank">License</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </main>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
      var win = navigator.platform.indexOf("Win") > -1;
      if (win && document.querySelector("#sidenav-scrollbar")) {
        var options = {
          damping: "0.5",
        };
        Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
      }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
  </body>
</html>
