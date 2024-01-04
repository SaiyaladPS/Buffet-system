<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$prod_id = $_POST['prod_id'];

$sql = "UPDATE `product` SET `prod_qty`= `prod_qty` - 1 WHERE `prod_id`='" . $prod_id . "'";
mysqli_query($conn, $sql);
?>