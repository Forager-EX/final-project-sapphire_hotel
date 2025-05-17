<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: /../admin_login.php");
    exit();
}

// Database credentials
$host = "localhost";
$user = "root";
$password = "";
$db = "sapphire_hotel";

// Create connection
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get admin_id from session
$admin_id = $_SESSION['admin_id'];

// Fetch admin name and email
$stmt = $conn->prepare("SELECT name, email FROM admin WHERE admin_id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

// Store user data
if ($result->num_rows === 1) {
    $userData = $result->fetch_assoc();
} else {
    die("User not found.");
}

// Close connection
$stmt->close();
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
    <!--     Fonts and icons     -->
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

  <body class="g-sidenav-show bg-gray-100">
    <aside
      class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
      id="sidenav-main"
    >
      <div class="sidenav-header">
        <i
          class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
          aria-hidden="true"
          id="iconSidenav"
        ></i>
        <a
          class="navbar-brand px-4 py-3 m-0"
          target="_blank"
        >
          <img HEAD src="./assets/img/logos/sh icon.png"
          src="./assets/img/logo.jpg" class="navbar-brand-img" width="26"
          height="26" alt="main_logo" />
          <span class="ms-1 text-sm text-dark">Sapphire Hotel</span>
        </a>
      </div>
      <hr class="horizontal dark mt-0 mb-2" />
      <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-dark" href="dashboard.php">
              <i class="material-symbols-rounded opacity-5">dashboard</i>
              <span class="nav-link-text ms-1">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="tables.php">
              <i class="material-symbols-rounded opacity-5">table_view</i>
              <span class="nav-link-text ms-1">User Profiles</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="bookings.php">
              <i class="material-symbols-rounded opacity-5">receipt_long</i>
              <span class="nav-link-text ms-1">Bookings</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="notifications.php">
              <i class="material-symbols-rounded opacity-5">notifications</i>
              <span class="nav-link-text ms-1">Notifications</span>
            </a>
          </li>
          <li class="nav-item mt-3">
            <h6
              class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5"
            >
              Account pages
            </h6>
          </li>
          <li class="nav-item">
            <a
              class="nav-link active bg-gradient-dark text-white"
              href="profile.php"
            >
              <i class="material-symbols-rounded opacity-5">person</i>
              <span class="nav-link-text ms-1">Profile</span>
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link text-dark" href="logout.php">
            <i class="material-symbols-rounded opacity-5">logout</i>
            <span class="nav-link-text ms-1">Log out</span>
          </a>
          </li>
        </ul>
      </div>
    </aside>
    <div class="main-content position-relative max-height-vh-100 h-100">
      <!-- Navbar -->
      <nav
        class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl"
        id="navbarBlur"
        data-scroll="true"
      >
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol
              class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5"
            >
              <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
              </li>
              <li
                class="breadcrumb-item text-sm text-dark active"
                aria-current="page"
              >
                Profile
              </li>
            </ol>
          </nav>
          <div
            class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4"
            id="navbar"
          >
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <div class="input-group input-group-outline">
                <label class="form-label">Type here...</label>
                <input type="text" class="form-control" />
              </div>
            </div>
            <ul
              class="navbar-nav d-flex align-items-center justify-content-end"
            >
              <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a
                  href="javascript:;"
                  class="nav-link text-body p-0"
                  id="iconNavbarSidenav"
                >
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                  </div>
                </a>
              </li>
              <li class="nav-item px-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0">
                  <i class="material-symbols-rounded fixed-plugin-button-nav"
                    >settings</i
                  >
                </a>
              </li>
              <li class="nav-item dropdown pe-3 d-flex align-items-center">
                <a
                  href="javascript:;"
                  class="nav-link text-body p-0"
                  id="dropdownMenuButton"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="material-symbols-rounded">notifications</i>
                </a>
              </li>
              <li class="nav-item d-flex align-items-center">
                <a
                  class="nav-link text-body font-weight-bold px-0"
                >
                  <i class="material-symbols-rounded">account_circle</i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid px-2 px-md-4">
        <div
          class="page-header min-height-300 border-radius-xl mt-4"
          style="
            background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
          "
        >
          <span class="mask bg-gradient-dark opacity-6"></span>
        </div>
        <div class="card card-body mx-2 mx-md-2 mt-n6">
          <div class="row gx-4 mb-2">
            <div class="col-auto">
              <div class="avatar avatar-xl position-relative">
                <img
                  src="./assets/img/profile.jpg"
                  alt="profile_image"
                  class="w-100 border-radius-lg shadow-sm"
                />
              </div>
            </div>
            <div class="col-auto my-auto">
              <div class="h-100">
                <p class="h6 text-dark">
                <span id="name"><?php echo htmlspecialchars($userData['name']); ?></span>
              </p>
                <p class="mb-0 font-weight-normal text-sm">Admin</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row">
              <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                  <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Platform Settings</h6>
                  </div>
                  <div class="card-body p-3">
                    <h6
                      class="text-uppercase text-body text-xs font-weight-bolder"
                    >
                      Account
                    </h6>
                    <ul class="list-group">
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input
                            class="form-check-input ms-auto"
                            type="checkbox"
                            id="flexSwitchCheckDefault"
                            checked
                          />
                          <label
                            class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                            for="flexSwitchCheckDefault"
                            >Email me when someone follows me</label
                          >
                        </div>
                      </li>
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input
                            class="form-check-input ms-auto"
                            type="checkbox"
                            id="flexSwitchCheckDefault1"
                          />
                          <label
                            class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                            for="flexSwitchCheckDefault1"
                            >Email me when someone answers on my post</label
                          >
                        </div>
                      </li>
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input
                            class="form-check-input ms-auto"
                            type="checkbox"
                            id="flexSwitchCheckDefault2"
                            checked
                          />
                          <label
                            class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                            for="flexSwitchCheckDefault2"
                            >Email me when someone mentions me</label
                          >
                        </div>
                      </li>
                    </ul>
                    <h6
                      class="text-uppercase text-body text-xs font-weight-bolder mt-4"
                    >
                      Application
                    </h6>
                    <ul class="list-group">
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input
                            class="form-check-input ms-auto"
                            type="checkbox"
                            id="flexSwitchCheckDefault3"
                          />
                          <label
                            class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                            for="flexSwitchCheckDefault3"
                            >New launches and projects</label
                          >
                        </div>
                      </li>
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input
                            class="form-check-input ms-auto"
                            type="checkbox"
                            id="flexSwitchCheckDefault4"
                            checked
                          />
                          <label
                            class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                            for="flexSwitchCheckDefault4"
                            >Monthly product updates</label
                          >
                        </div>
                      </li>
                      <li class="list-group-item border-0 px-0 pb-0">
                        <div class="form-check form-switch ps-0">
                          <input
                            class="form-check-input ms-auto"
                            type="checkbox"
                            id="flexSwitchCheckDefault5"
                          />
                          <label
                            class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                            for="flexSwitchCheckDefault5"
                            >Subscribe to newsletter</label
                          >
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                  <div class="card-header pb-0 p-3">
                    <div class="row">
                      <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-0">Profile Information</h6>
                      </div>
                      <div class="col-md-4 text-end">
                        <a href="javascript:;">
                          <i
                            class="fas fa-user-edit text-secondary text-sm"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Edit Profile"
                          ></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-3">
                    <p class="text-sm">
                      Administrator overseeing reservations, guest management, and system operations for Sapphire Hotel, ensuring seamless booking experiences and operational efficiency.
                    </p>
                    <hr class="horizontal gray-light my-4" />
                    <ul class="list-group">
                      <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                        <strong class="text-dark">Full Name:</strong> &nbsp;
                        <p> <span id="name"><?php echo htmlspecialchars($userData['name']); ?></span></p>
                      </li>
                      <li class="list-group-item border-0 ps-0 text-sm">
                        <strong class="text-dark">Email:</strong>
                        <span id="email"><?php echo htmlspecialchars($userData['email'] ?? 'N/A'); ?></span>
                      </li>

                      <li class="list-group-item border-0 ps-0 text-sm">
                        <strong class="text-dark">Location:</strong> &nbsp; Philippines
                      </li>
                      <li class="list-group-item border-0 ps-0 pb-0">
                        <strong class="text-dark text-sm">Social:</strong>
                        &nbsp;
                        <a
                          class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0"
                          href="javascript:;"
                        >
                          <i class="fab fa-facebook fa-lg"></i>
                        </a>
                        <a
                          class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0"
                          href="javascript:;"
                        >
                          <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a
                          class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0"
                          href="javascript:;"
                        >
                          <i class="fab fa-instagram fa-lg"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer py-4">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div
                class="copyright text-center text-sm text-muted text-lg-start"
              >
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                , made <i class="fa fa-heart"></i> by
                <a
            
                  class="font-weight-bold"
                  target="_blank"
                  >Sapphire Hotel</a
                >
              </div>
            </div>
            <div class="col-lg-6">
              <ul
                class="nav nav-footer justify-content-center justify-content-lg-end"
              >
                <li class="nav-item">
                  <a
                    class="nav-link text-muted"
                    target="_blank"
                    >Sapphire Hotel</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link text-muted"
                    target="_blank"
                    >About Us</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link text-muted"
                    target="_blank"
                    >Blog</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link pe-0 text-muted"
                    target="_blank"
                    >License</a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <div class="fixed-plugin">
      <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="material-symbols-rounded py-2">settings</i>
      </a>
      <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3">
          <div class="float-start">
            <h5 class="mt-3 mb-0">Material UI Configurator</h5>
            <p>See our dashboard options.</p>
          </div>
          <div class="float-end mt-4">
            <button
              class="btn btn-link text-dark p-0 fixed-plugin-close-button"
            >
              <i class="material-symbols-rounded">clear</i>
            </button>
          </div>
          <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1" />
        <div class="card-body pt-sm-3 pt-0">
          <!-- Sidebar Backgrounds -->
          <div>
            <h6 class="mb-0">Sidebar Colors</h6>
          </div>
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="badge-colors my-2 text-start">
              <span
                class="badge filter bg-gradient-primary"
                data-color="primary"
                onclick="sidebarColor(this)"
              ></span>
              <span
                class="badge filter bg-gradient-dark active"
                data-color="dark"
                onclick="sidebarColor(this)"
              ></span>
              <span
                class="badge filter bg-gradient-info"
                data-color="info"
                onclick="sidebarColor(this)"
              ></span>
              <span
                class="badge filter bg-gradient-success"
                data-color="success"
                onclick="sidebarColor(this)"
              ></span>
              <span
                class="badge filter bg-gradient-warning"
                data-color="warning"
                onclick="sidebarColor(this)"
              ></span>
              <span
                class="badge filter bg-gradient-danger"
                data-color="danger"
                onclick="sidebarColor(this)"
              ></span>
            </div>
          </a>
          <!-- Sidenav Type -->
          <div class="mt-3">
            <h6 class="mb-0">Sidenav Type</h6>
            <p class="text-sm">Choose between different sidenav types.</p>
          </div>
          <div class="d-flex">
            <button
              class="btn bg-gradient-dark px-3 mb-2"
              data-class="bg-gradient-dark"
              onclick="sidebarType(this)"
            >
              Dark
            </button>
            <button
              class="btn bg-gradient-dark px-3 mb-2 ms-2"
              data-class="bg-transparent"
              onclick="sidebarType(this)"
            >
              Transparent
            </button>
            <button
              class="btn bg-gradient-dark px-3 mb-2 active ms-2"
              data-class="bg-white"
              onclick="sidebarType(this)"
            >
              White
            </button>
          </div>
          <p class="text-sm d-xl-none d-block mt-2">
            You can change the sidenav type just on desktop view.
          </p>
          <!-- Navbar Fixed -->
          <div class="mt-3 d-flex">
            <h6 class="mb-0">Navbar Fixed</h6>
            <div class="form-check form-switch ps-0 ms-auto my-auto">
              <input
                class="form-check-input mt-1 ms-auto"
                type="checkbox"
                id="navbarFixed"
                onclick="navbarFixed(this)"
              />
            </div>
          </div>
          <hr class="horizontal dark my-3" />
          <div class="mt-2 d-flex">
            <h6 class="mb-0">Light / Dark</h6>
            <div class="form-check form-switch ps-0 ms-auto my-auto">
              <input
                class="form-check-input mt-1 ms-auto"
                type="checkbox"
                id="dark-version"
                onclick="darkMode(this)"
              />
            </div>
          </div>
          <hr class="horizontal dark my-sm-4" />
        </div>
      </div>
    </div>
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
