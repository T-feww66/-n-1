<?php
$con = new mysqli("localhost","root","","webbanhang");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  exit();
}
$con -> set_charset("utf8");
?>