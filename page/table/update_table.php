<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$ta_id = $_POST['ta_id'];
$ta_name = $_POST['ta_name'];
$ta_remak = $_POST['ta_remak'];

$sql = "UPDATE `table` SET `ta_name`='" . $ta_name . "',`ta_remak`='" . $ta_remak . "' WHERE ta_id = '" . $ta_id . "'";
$insert = mysqli_query($conn, $sql);

?>