<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$des_id = $_POST['delete_id'];
$im_qty = $_POST['im_qty'];
$prod_id = $_POST['prod_id'];
$sql = "DELETE FROM imported WHERE im_id = '" . $des_id . "'";
$query = mysqli_query($conn, $sql);
if ($query) {
    $update = "UPDATE `product` SET `prod_qty`= `prod_qty` - " . $im_qty . " WHERE `prod_id` = " . $prod_id . "";
    mysqli_query($conn, $update);
    echo json_encode(200);
} else {
    echo json_encode(500);
}
?>