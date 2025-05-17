<?php
session_start();

// Database connection
$servername = "localhost"; // Database server
$username = "root"; // Database username
$password = ""; // Database password (default for XAMPP)
$dbname = "sapphire_hotel"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch notifications from the database
$sql = "SELECT * FROM notifications";
$result = $conn->query($sql);

$notifications = [];

if ($result->num_rows > 0) {
    // Fetch notifications into an array
    while($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
} else {
    $notifications = [];
}

$conn->close();
?>>

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
          <img
            src="./assets/img/logos/sh icon.png"
            class="navbar-brand-img"
            width="26"
            height="26"
            alt="main_logo"
          />
          <span class="ms-1 text-sm text-dark">Sapphire Hotel</span>
        </a>
      </div>
      <hr class="horizontal dark mt-0 mb-2" />
      <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a
              class="nav-link active bg-gradient-dark text-white"
              href="dashboard.php"
            >
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
            <a class="nav-link text-dark" href="profile.php">
              <i class="material-symbols-rounded opacity-5">person</i>
              <span class="nav-link-text ms-1">Profile</span>
            </a>
          <li class="nav-item">
          <a class="nav-link text-dark" href="logout.php">
            <i class="material-symbols-rounded opacity-5">logout</i>
            <span class="nav-link-text ms-1">Log out</span>
          </a>
          </li>
          </li>
          

        </li>

        </ul>
      </div>
    </aside>
    <main
      class="main-content position-relative max-height-vh-100 h-100 border-radius-lg"
    >
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
                Dashboard
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
                  href="profile.php"
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
      <div class="container-fluid py-2">
        <div class="row">
          <div class="ms-3">
            <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
            <p class="mb-4">
              Check the sales, value and bounce rate by country.
            </p>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                 <div>
                    <p class="text-sm mb-0 text-capitalize">Total Bookings</p>
                    <script>
                        fetch('total_booking.php')  // Assuming the PHP script is named 'get_total_bookings.php'
                            .then(response => response.json())
                            .then(data => {
                                const bookings = data.total_bookings || 0;
                                document.getElementById('bookingsBox').textContent = bookings.toLocaleString();  // Format number with commas
                            })
                            .catch(error => {
                                document.getElementById('bookingsBox').textContent = 'Error loading bookings';
                                console.error('Error fetching bookings:', error);
                            });
                    </script>
                    <h4 class="mb-0" id="bookingsBox">0</h4>
                </div> 
                  <div
                    class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg"
                  >
                    <i class="material-symbols-rounded opacity-10">weekend</i>
                  </div>
                </div>
              </div>
              <hr class="dark horizontal my-0" />
              <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm">
                  <span class="text-success font-weight-bolder">
              <div>
                <p class="text-sm mb-0 text-capitalize" id="weeklyChange">0% than last week</p>
                <script>
              fetch('get_weekly_booking_change.php')
                .then(response => response.json())
                .then(data => {
                  const percent = data.percent_change;
                  const indicator = percent >= 0 ? '+' : '';
                  const color = percent >= 0 ? 'green' : 'red';
                  document.getElementById('weeklyChange').innerHTML =
                    `<span style="color: ${color}; font-weight: bold;">${indicator}${percent}%</span> than last week`;
                })
                .catch(error => {
                  document.getElementById('weeklyChange').textContent = 'Error loading data';
                  console.error('Error:', error);
                });
            </script>



              </div> </span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                 <div>
                    <p class="text-sm mb-0 text-capitalize">Number of Users</p>
                    <div>
                      <script>
                        fetch('get_user_count.php')
                          .then(response => response.json())
                          .then(data => {
                            const userCount = data.user_count || 0;
                            document.getElementById('userCountBox').textContent = userCount.toLocaleString();
                          })
                          .catch(error => {
                            document.getElementById('userCountBox').textContent = 'Error';
                            console.error('Error fetching user count:', error);
                          });
                      </script>
                      <h4 class="mb-0" id="userCountBox">0</h4>
                    </div>

                  </div>
  
                  <div
                    class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg"
                    class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg"
                  >
                    <i class="material-symbols-rounded opacity-10">person</i>
                  </div>
                </div>
              </div>
              <hr class="dark horizontal my-0" />
              <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm" id="userWeeklyChange"></p>
              <script>
                fetch('get_weekly_user_change.php')
                  .then(response => response.json())
                  .then(data => {
                    const percent = data.percent_change;
                    const indicator = percent >= 0 ? '+' : '';
                    const color = percent >= 0 ? 'green' : 'red';
                    document.getElementById('userWeeklyChange').innerHTML = 
                      `<span style="color: ${color}; font-weight: bold;">${indicator}${percent}%</span> than last week`;
                  })
                  .catch(error => {
                    document.getElementById('userWeeklyChange').textContent = 'Error loading data';
                    console.error('Error fetching user change:', error);
                  });
              </script> 
                </p>
              </div>
            </div>
          </div> 
          <div class="col-xl-3 col-sm-6">
            <div class="card">
              <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                  <div>
                    <p class="text-sm mb-0 text-capitalize">Sales</p>
                    <script>
                    fetch('get_total_sales.php')
                  .then(response => response.json())
                  .then(data => {
                    const sales = data.total_sales || "0";
                    document.getElementById('salesBox').textContent = `₱ ${sales}`;
                  })
                  .catch(error => {
                    document.getElementById('salesBox').textContent = 'Error loading sales';
                    console.error('Error fetching sales:', error);
                  });
                    </script>
                    <script>
                      fetch('get_total_sales.php')
                        .then(response => response.json())
                        .then(data => {
                          const sales = data.total_sales || "0";
                          document.getElementById('salesBox').textContent = `₱ ${sales}`;
                        })
                        .catch(error => {
                          document.getElementById('salesBox').textContent = 'Error loading sales';
                          console.error('Error fetching sales:', error);
                        });

                  </script>
                    <h4 class="mb-0" id="salesBox">₱ 0</h4>
                  </div>
                  <div
                    class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg"
                  >
                    <i class="material-symbols-rounded opacity-10">weekend</i>
                  </div>
                </div>
              </div>
              <hr class="dark horizontal my-0" />
              <div class="card-footer p-2 ps-3">
                <p class="text-sm mb-0 text-capitalize">
                <span id="monthlySalesChange" style="font-weight: bold; color: gray;">0%</span> than last month
                </p><script>
                fetch('get_monthly_sales_change.php')
                  .then(response => {
                    if (!response.ok) throw new Error("Network response error");
                    return response.json();
                  })
                  .then(data => {
                    if (data.error) throw new Error(data.error);

                    const percent = data.percent_change;
                    const indicator = percent >= 0 ? '+' : '';
                    const color = percent >= 0 ? 'green' : 'red';

                    const span = document.getElementById('monthlySalesChange');
                    span.textContent = `${indicator}${percent}%`;
                    span.style.color = color;
                  })
                  .catch(error => {
                    const span = document.getElementById('monthlySalesChange');
                    span.textContent = 'Error';
                    span.style.color = 'red';
                    console.error('Fetch error:', error);
                  });
              </script>

              </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h6 class="mb-0">Website Views</h6>
                <p class="text-sm">Last Campaign Performance</p>
                <div class="pe-2">
                  <div class="chart">
                    <canvas
                      id="chart-bars"
                      class="chart-canvas"
                      height="170"
                    ></canvas>
                  </div>
                </div>
                <hr class="dark horizontal" />
                <div class="d-flex">
                  <i class="material-symbols-rounded text-sm my-auto me-1"
                    >schedule</i
                  >
                  <p class="mb-0 text-sm">campaign sent 2 days ago</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h6 class="mb-0">Daily Sales</h6>
                <p class="text-sm">
                  (<span class="font-weight-bolder">+15%</span>) increase in
                  today sales.
                </p>
                <div class="pe-2">
                  <div class="chart">
                    <canvas
                      id="chart-line"
                      class="chart-canvas"
                      height="170"
                    ></canvas>
                  </div>
                </div>
                <hr class="dark horizontal" />
                <div class="d-flex">
                  <i class="material-symbols-rounded text-sm my-auto me-1"
                    >schedule</i
                  >
                  <p class="mb-0 text-sm">updated 4 min ago</p>
                </div>
              </div>
            </div>
          </div>
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card h-75">
            <div class="card-header pb-0">
              <h6>Notifications</h6>
              <p class="text-sm">
                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                <span class="font-weight-bold"></span> 
              </p>
            </div>
            <!-- Set fixed height and enable scroll here -->
            <div class="card-body p-3" style="max-height: 400px; overflow-y: auto;">
              <div class="timeline timeline-one-side">
                <?php foreach ($notifications as $notification): ?>
                  <?php
                      $formatted_message = "📅 New Booking Alert!\n\n";
                      $formatted_message .= "Guest: " . $notification['name'] . "\n";
                      $formatted_message .= "A new reservation has been made. Please review and confirm availability.\n\n";

                      $alertClass = match ($notification['type']) {
                          'booking' => '',
                          'cancel' => 'danger',
                          'update' => 'warning',
                          default => 'info',
                      };
                  ?>
                  <div class="timeline-item">
                    <div class="timeline-time">
                      <span class="badge bg-<?php echo $alertClass; ?>">
                        <?php echo ucfirst($notification['type']); ?>
                      </span>
                    </div>
                    <div class="timeline-content" style="background-color: #e6f2ff; border: 1px solid #b3d8ff; border-radius: 6px; padding: 10px; margin-top: 5px;">
                      <h5 class="text-sm text-dark mb-0" style="font-size: 0.875rem;"><?php echo nl2br($formatted_message); ?></h5>
                    </div>

                  </div>
                <?php endforeach; ?>
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
                    >Sapphire Hotel</a>
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
    </main>
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
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
      var ctx = document.getElementById("chart-bars").getContext("2d");

      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["M", "T", "W", "T", "F", "S", "S"],
          datasets: [
            {
              label: "Views",
              tension: 0.4,
              borderWidth: 0,
              borderRadius: 4,
              borderSkipped: false,
              backgroundColor: "#43A047",
              data: [50, 45, 22, 28, 50, 60, 76],
              barThickness: "flex",
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            },
          },
          interaction: {
            intersect: false,
            mode: "index",
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5],
                color: "#e5e5e5",
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 500,
                beginAtZero: true,
                padding: 10,
                font: {
                  size: 14,
                  lineHeight: 2,
                },
                color: "#737373",
              },
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5],
              },
              ticks: {
                display: true,
                color: "#737373",
                padding: 10,
                font: {
                  size: 14,
                  lineHeight: 2,
                },
              },
            },
          },
        },
      });

      var ctx2 = document.getElementById("chart-line").getContext("2d");

      new Chart(ctx2, {
        type: "line",
        data: {
          labels: ["J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D"],
          datasets: [
            {
              label: "Sales",
              tension: 0,
              borderWidth: 2,
              pointRadius: 3,
              pointBackgroundColor: "#43A047",
              pointBorderColor: "transparent",
              borderColor: "#43A047",
              backgroundColor: "transparent",
              fill: true,
              data: [120, 230, 130, 440, 250, 360, 270, 180, 90, 300, 310, 220],
              maxBarThickness: 6,
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            },
            tooltip: {
              callbacks: {
                title: function (context) {
                  const fullMonths = [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December",
                  ];
                  return fullMonths[context[0].dataIndex];
                },
              },
            },
          },
          interaction: {
            intersect: false,
            mode: "index",
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [4, 4],
                color: "#e5e5e5",
              },
              ticks: {
                display: true,
                color: "#737373",
                padding: 10,
                font: {
                  size: 12,
                  lineHeight: 2,
                },
              },
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5],
              },
              ticks: {
                display: true,
                color: "#737373",
                padding: 10,
                font: {
                  size: 12,
                  lineHeight: 2,
                },
              },
            },
          },
        },
      });

      var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

      new Chart(ctx3, {
        type: "line",
        data: {
          labels: [
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          datasets: [
            {
              label: "Tasks",
              tension: 0,
              borderWidth: 2,
              pointRadius: 3,
              pointBackgroundColor: "#43A047",
              pointBorderColor: "transparent",
              borderColor: "#43A047",
              backgroundColor: "transparent",
              fill: true,
              data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
              maxBarThickness: 6,
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            },
          },
          interaction: {
            intersect: false,
            mode: "index",
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [4, 4],
                color: "#e5e5e5",
              },
              ticks: {
                display: true,
                padding: 10,
                color: "#737373",
                font: {
                  size: 14,
                  lineHeight: 2,
                },
              },
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [4, 4],
              },
              ticks: {
                display: true,
                color: "#737373",
                padding: 10,
                font: {
                  size: 14,
                  lineHeight: 2,
                },
              },
            },
          },
        },
      });
    </script>
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
    <script src="./assets/js/material-dashboard.min.js?v=3.2.0"></script>
  </body>
</html>
