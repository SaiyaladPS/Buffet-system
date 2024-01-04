<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$ty_name = $_POST['ty_name'];

$check_pro = mysqli_query($conn, "SELECT * FROM type WHERE ty_name = '$ty_name'");

$row_pro = mysqli_num_rows($check_pro);

echo json_encode($row_pro);
?>