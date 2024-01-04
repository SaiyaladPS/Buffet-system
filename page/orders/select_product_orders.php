<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';

$pro_id = $_POST['id'];

$select_sql_pro = "SELECT * FROM product WHERE prod_id = '$pro_id'";
$query_pro = mysqli_query($conn, $select_sql_pro);
$rows_pro = mysqli_fetch_assoc($query_pro);
echo json_encode($rows_pro);
?>