<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$prod_id = $_POST['prod_id'];
$im_img = $_POST['im_img'];
$im_name = $_POST['im_name'];
$im_qty = $_POST['im_qty'];
$im_sprice = $_POST['im_sprice'];


$sql = "INSERT INTO `imported`(`im_img`, `im_name`, `im_qty`, `im_sprice`, `im_date`, `im_time`, `prod_id`) 
VALUES ('" . $im_img . "','" . $im_name . "','" . $im_qty . "','" . $im_sprice . "',CURDATE(),CURTIME(),'" . $prod_id . "')";
if (mysqli_query($conn, $sql)) {
    $update = "UPDATE `product` SET `prod_qty`= `prod_qty` + " . $im_qty . ", `prod_sprice` = '" . $im_sprice . "' WHERE `prod_id` = " . $prod_id . "";
    mysqli_query($conn, $update);
}
?>