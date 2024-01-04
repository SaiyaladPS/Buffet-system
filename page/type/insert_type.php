<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$ty_name = $_POST['ty_name'];
$ty_remak = $_POST['ty_remak'];
$ty_price = $_POST['ty_price'];
$sql = "INSERT INTO type(ty_name, ty_price, ty_remak) VALUES ('" . $ty_name . "','" . $ty_price . "','" . $ty_remak . "')";
$insert = mysqli_query($conn, $sql);

?>