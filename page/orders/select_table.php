<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require "../../db/connect.php";
$ta_id = $_POST['ta_id'];

$sql = "SELECT * FROM `bil` as p1 INNER JOIN `product` as p2 ON p1.prod_id = p2.prod_id INNER JOIN `table` as p3 ON p1.ta_id = p3.ta_id WHERE p3.ta_id = '" . $ta_id . "'";
$query = mysqli_query($conn, $sql);

$rows = array(); // Initialize an array to store the rows

while ($row = mysqli_fetch_assoc($query)) {
    $rows[] = $row;
}

echo json_encode($rows);
?>