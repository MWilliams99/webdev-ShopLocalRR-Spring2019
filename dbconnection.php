<?php
  $host_name = 'host_placeholder';
  $database = 'database_placeholder';
  $user_name = 'username_placeholder';
  $password = 'password_placeholder';
  $dbconnection = mysqli_connect($host_name, $user_name, $password, $database);

  if (mysqli_errno()) {
    die('<p>Failed to connect to MySQL: '.mysqli_error().'</p>');
  } else {
    //echo '<p>Connection to MySQL server successfully established.</p >';
  }
?>
