<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$prod_id = $_POST["prod_id"];
$prod_name = $_POST["prod_name"];
$prod_price = $_POST["prod_price"];
$prod_remak = $_POST["prod_remak"];

$sql = "UPDATE `product` SET `prod_name`='" . $prod_name . "',`prod_price`='" . $prod_price . "',`prod_remak`='" . $prod_remak . "' WHERE prod_id = '" . $prod_id . "'";
$insert = mysqli_query($conn, $sql);

?>