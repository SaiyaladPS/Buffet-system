<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$us_username = $_POST['us_username'];
$us_passowrd = $_POST['us_password'];

$check_pro = mysqli_query($conn, "SELECT * FROM user WHERE us_username = '" . $us_username . "' AND us_password ='" . $us_passowrd . "'");

$row_pro = mysqli_num_rows($check_pro);

echo json_encode($row_pro);
?>