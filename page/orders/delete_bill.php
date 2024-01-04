<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$bi_id = $_POST['bi_id'];
$prod_id = $_POST['prod_id'];
$prod_qty = $_POST['prod_qty'];

$sql = "DELETE FROM `bil` WHERE bi_id = '" . $bi_id . "'";
$query = mysqli_query($conn, $sql);
if ($query) {
    $sql = "UPDATE `product` SET `prod_qty`= `prod_qty` + " . $prod_qty . " WHERE `prod_id`='" . $prod_id . "'";
    mysqli_query($conn, $sql);
    echo json_encode(200);
} else {
    echo json_encode(500);
}
?>