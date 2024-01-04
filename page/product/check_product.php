<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$prod_name = $_POST['prod_name'];

$check_pro = mysqli_query($conn, "SELECT * FROM product WHERE prod_name = '" . $prod_name . "'");

$row_pro = mysqli_num_rows($check_pro);

echo json_encode($row_pro);
?>