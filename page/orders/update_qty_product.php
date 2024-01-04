<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$prod_id = $_POST['Id'];
$prod_qty = $_POST['qty'];

$sql = "UPDATE `product` SET `prod_qty`= `prod_qty` + " . $prod_qty . " WHERE `prod_id`='" . $prod_id . "'";
mysqli_query($conn, $sql);
?>