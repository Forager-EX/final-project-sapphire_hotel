<?php
// admin_dashboard.php
session_start();

// You can add session checking here if needed:
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: admin_login.php");
//     exit();
// }

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'sapphire_hotel';

// DB Connection
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all users
$sql = "SELECT name, email, createdAt FROM user";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registered Users</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 40px;
      background-color: #f9f9f9;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 15px;
      border: 1px solid #ddd;
      text-align: center;
    }

    th {
      background-color: #0066cc;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .container {
      max-width: 900px;
      margin: auto;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Registered Users</h2>

  <table>
    <thead>
      <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>Date Registered</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= $row['createdAt'] ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="3">No users found</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>

<?php
$conn->close();
?>
