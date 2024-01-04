<?php
require "db/connect.php";
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM `user` WHERE us_username ='" . $username . "' AND us_password = md5('" . $password . "')";
$query = mysqli_query($conn, $sql);
$row = mysqli_num_rows($query);
echo json_encode($row);
?>