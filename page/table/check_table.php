<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$ta_name = $_POST['ta_name'];

$check_pro = mysqli_query($conn, "SELECT * FROM `table` WHERE ta_name = '$ta_name'");

$row_pro = mysqli_num_rows($check_pro);

echo json_encode($row_pro);
?>