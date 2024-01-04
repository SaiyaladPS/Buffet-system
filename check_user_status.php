<?php
session_start();
require "db/connect.php";
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM `user` WHERE us_username ='" . $username . "' AND us_password = md5('" . $password . "')";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
$_SESSION['username'] = $row['us_name'];
$_SESSION['profile'] = $row['us_img'];
?>