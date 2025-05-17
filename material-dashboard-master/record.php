<?php
include 'db_connect.php';

$sql = "SELECT * FROM booking"; // Adjust table name and fields as needed
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Booking Records</title>
</head>
<body>
  <h2>Booking Records</h2>
  <table border="1">
    <tr>
      <th>Booking ID</th>
      <th>User ID</th>
      <th>Room ID</th>
      <th>Check-in</th>
      <th>Check-out</th>
      <th>Status</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['booking_id']) ?></td>
      <td><?= htmlspecialchars($row['user_id']) ?></td>
      <td><?= htmlspecialchars($row['room_id']) ?></td>
      <td><?= htmlspecialchars($row['check_in']) ?></td>
      <td><?= htmlspecialchars($row['check_out']) ?></td>
      <td><?= htmlspecialchars($row['status']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
