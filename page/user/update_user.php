<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$us_name = $_POST['us_name'];
$us_tel = $_POST['us_tel'];
$us_salary = $_POST['us_salary'];
$us_username = $_POST['us_username'];
$us_status = $_POST['us_status'];
$us_id = $_POST['us_id'];

// Insert image information into the database
$sql = "UPDATE `user` SET `us_name`='" . $us_name . "',`us_tel`='" . $us_tel . "',`us_salary`='" . $us_salary . "',`us_username`='" . $us_username . "',`us_status`='" . $us_status . "' WHERE us_id = '" . $us_id . "' ";
mysqli_query($conn, $sql);

?>