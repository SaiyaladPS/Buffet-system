<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$ty_id = $_POST['ty_id'];
$ty_name = $_POST['ty_name'];
$ty_remak = $_POST['ty_remak'];
$ty_price = $_POST['ty_price'];

$sql = "UPDATE `type` SET `ty_name`='" . $ty_name . "',`ty_price`='" . $ty_price . "',`ty_remak`='" . $ty_remak . "' WHERE ty_id = '" . $ty_id . "'";
$insert = mysqli_query($conn, $sql);

?>