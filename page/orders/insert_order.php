<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$count = $_POST['count'];
$ta_id2 = $_POST['ta_id'];
for ($i = 0; $i < $count; $i++) {
    $prod_id = $_POST['data'][$i]['prod_id'];
    $qty = $_POST['data'][$i]['qty'];
    $ta_id = $_POST['ta_id'];
    $total = $_POST['total'];
    $order_sql = "INSERT INTO `bil`(`prod_id`, `ta_id`, `bi_qty`,`bi_am`)
     VALUES ('" . $prod_id . "','" . $ta_id . "','" . $qty . "','" . $total . "')";
    mysqli_query($conn, $order_sql);
}
$sql_update = mysqli_query($conn, "UPDATE `table` SET `ta_status`='Full' WHERE ta_id = '" . $ta_id2 . "'")
    ?>