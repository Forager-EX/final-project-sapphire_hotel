<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: /../admin_login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$dbname = "sapphire_hotel";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT full_name, booking_id, reservation_date, check_in, check_out, room_type, total_price 
        FROM booking 
        ORDER BY booking_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sapphire Hotel Admin</title>
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" />
  <link rel="icon" type="image/png" href="./assets/img/logos/logo.jpg" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
  <link href="./assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" id="pagestyle" />
</head>

<body class="g-sidenav-show bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="#">
        <img src="./assets/img/logos/sh icon.png" class="navbar-brand-img" width="26" height="26" alt="main_logo" />
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
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="profile.php">
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

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-2">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Booking Records</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Reservation ID</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Reservation Date</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Check-In</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Check-Out</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Room Type</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Amount</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($result->num_rows > 0): ?>
                  <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="./assets/img/booked.png" class="avatar avatar-sm me-3 border-radius-lg" alt="user" />
                          <p class="text-xs font-weight-bold mb-0"><?= htmlspecialchars($row['full_name']) ?></p>
                        </div>
                      </td>
                      <td><p class="text-xs font-weight-bold mb-0"><?= $row['booking_id'] ?></p></td>
                      <td><p class="text-xs font-weight-bold mb-0"><?= $row['reservation_date'] ?></p></td>
                      <td><p class="text-xs font-weight-bold mb-0"><?= $row['check_in'] ?></p></td>
                      <td><p class="text-xs font-weight-bold mb-0"><?= $row['check_out'] ?></p></td>
                      <td><p class="text-xs font-weight-bold mb-0"><?= htmlspecialchars($row['room_type']) ?></p></td>
                      <td><p class="text-xs font-weight-bold mb-0">₱<?= number_format($row['total_price'], 2) ?></p></td>
                      <td>
                        <button 
                          class="btn btn-sm btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#editBookingModal"
                          onclick='fillEditBookingForm(<?= json_encode($row) ?>)'>
                          Edit
                        </button>

                        <a href="delete_booking.php?id=<?= $row['booking_id'] ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Are you sure you want to delete this booking?');">
                          Delete
                        </a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="8" class="text-center text-secondary">No bookings found.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Edit Guest Modal -->
<div class="modal fade" id="editBookingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="edit_booking.php">
        <div class="modal-header">
          <h5 class="modal-title">Edit Booking</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="booking_id" id="editBookingId">
          
          <div class="mb-3">
            <label>Full Name</label>
            <input type="text" class="form-control" name="full_name" id="editFullName" required>
          </div>
          
          <div class="mb-3">
            <label>Check-in Date</label>
            <input type="date" class="form-control" name="check_in" id="editCheckIn" required>
          </div>
          
          <div class="mb-3">
            <label>Check-out Date</label>
            <input type="date" class="form-control" name="check_out" id="editCheckOut" required>
          </div>
          
          <div class="mb-3">
            <label>Room Type</label>
            <input type="text" class="form-control" name="room_type" id="editRoomType" required>
          </div>
          
          <div class="mb-3">
            <label>Total Price</label>
            <input type="number" step="0.01" class="form-control" name="total_price" id="editTotalPrice" required>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function fillEditBookingForm(booking) {
    document.getElementById('editBookingId').value = booking.booking_id;
    document.getElementById('editFullName').value = booking.full_name;
    document.getElementById('editCheckIn').value = booking.check_in;
    document.getElementById('editCheckOut').value = booking.check_out;
    document.getElementById('editRoomType').value = booking.room_type;
    document.getElementById('editTotalPrice').value = booking.total_price;
  }
</script>

  </main>

  <footer class="footer py-4">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6 mb-lg-0 mb-4">
          <div class="text-center text-sm text-muted text-lg-start">
            © <script>document.write(new Date().getFullYear());</script>, made with <i class="fa fa-heart"></i> by <a href="#" class="font-weight-bold">Sapphire Hotel</a>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item"><a href="#" class="nav-link text-muted">About Us</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-muted">Blog</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-muted">License</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), { damping: '0.5' });
    }
  </script>
  <script src="./assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>
</html>
