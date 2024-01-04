<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
// Get the current date and time
$currentDateTime = date('d/m/y H:i:s');
if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require "../../db/connect.php";

$count = $_GET['count'];

$ta_id = $_GET['data'][0]['ta_id'];
$sql_query_ta = mysqli_query($conn, "SELECT * FROM `table` WHERE ta_id ='" . $ta_id . "'");
$row_table = mysqli_fetch_assoc($sql_query_ta);
$sql_query_ta_delete = mysqli_query($conn, "DELETE FROM `bil` WHERE ta_id ='" . $ta_id . "'");
$sql_query_ta_update = mysqli_query($conn, "UPDATE `table` SET `ta_status`='Loose' WHERE ta_id ='" . $ta_id . "'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
@media print {
    .offcanvas {
        display: none;
    }

    .row {
        display: none;
    }

    #Bill {
        display: block;
    }
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

#Bill {
    display: none;
}

.bill {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.bill-header {
    text-align: center;
}

.bill-details {
    margin-top: 20px;
}

.bill-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.bill-table th,
.bill-table td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: left;
}

.bill-table thead {
    background-color: #f2f2f2;
}

.bill-table tfoot {
    font-weight: bold;
}
</style>

<body>
    <div class="bill">
        <div class="bill-header">
            <h1>Invoice</h1>
            <p>ວັນທີ:
                <?php echo $currentDateTime ?>
            </p>

        </div>
        <div class="bill-details">
            <p><strong>ອອກບິນໂດຍ: </strong>
                fff
            </p>
            <p><strong>ໂທ: </strong>
                sdf
            </p>
            <p><strong>ໂຕະ: </strong>
                <?php echo $row_table['ta_name'] ?>
            </p>
        </div>
        <table class="bill-table">
            <thead>
                <tr>
                    <th>ຊື່ສິນຄ້າ</th>
                    <th>ຈຳນວນ</th>
                    <th>ລາຄາ</th>
                    <th>ລວມ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalProfit = 0;
                $mony_qty = 0;
                for ($i = 0; $i < $count; $i++) {
                    ?>
                <tr>
                    <td>
                        <?php echo $_GET['data'][$i]['prod_name'] ?>
                    </td>
                    <td>
                        <?php $qty = $_GET['data'][$i]['bi_qty'];
                            echo $qty ?>
                    </td>
                    <td>
                        <?php echo number_format($_GET['data'][$i]['prod_price']) ?> ກີບ
                    </td>
                    <td>
                        <?php
                            $subtotal = $_GET['data'][$i]['bi_qty'] * $_GET['data'][$i]['prod_price'];
                            echo number_format($subtotal) ?> ກີບ
                    </td>
                </tr>
                <?php $totalProfit += $subtotal;
                    $mony_qty += $qty;
                    $sql_update_ta_insert = mysqli_query($conn, "UPDATE `product` SET `prod_qty`= `prod_qty` - " . $qty . " WHERE `prod_id` = " . $_GET['data'][$i]['prod_id'] . "");
                    $query_order = mysqli_query($conn, "INSERT INTO `orders`(`prod_id`, `or_qty`) VALUES ('" . $_GET['data'][$i]['prod_id'] . "','".$qty."')");
                    ?>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>
                            <?php echo number_format($totalProfit) ?> ກີບ
                        </strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>

<?php

$sql_query_ta_insert = mysqli_query($conn, "INSERT INTO `mony`(`mony_qty`,`mony_name`, `mony_date`) VALUES ('" . $mony_qty . "','" . $totalProfit . "',curdate())");


?>