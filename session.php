<?php
   
   session_start();
   require_once('db.php');

   $user_check = $_SESSION['user_id'];
   
   $ses_sql = mysqli_query($conn,"SELECT * FROM user WHERE user_id = '$user_check'; ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = ucfirst($row['name']);
   $user_id = $row['user_id'];
   
   if(!isset($_SESSION['user_id'])){
      header("location:login.php");
   }
?>