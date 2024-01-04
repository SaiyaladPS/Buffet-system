<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$ta_name = $_POST['ta_name'];
$ta_remak = $_POST['ta_remak'];
$sql = "INSERT INTO `table`(`ta_name`,`ta_status`, `ta_remak`) VALUES ('" . $ta_name . "','Loose','" . $ta_remak . "')";
$insert = mysqli_query($conn, $sql);
?>