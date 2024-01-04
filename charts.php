<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: 404.php");
}
require "db/connect.php";
$query = mysqli_query($conn, "SELECT * FROM `table`");
$query_1 = mysqli_query($conn, "SELECT * FROM `table` WHERE ta_status ='Loose'");
$tal_d = mysqli_num_rows($query);
$tal_l = mysqli_num_rows($query_1);
$query_2 = mysqli_query($conn, "SELECT SUM(mony_name) as monye FROM `mony`");
$tal_2 = mysqli_fetch_assoc($query_2);
$query_3 = mysqli_query($conn, "SELECT SUM(im_sprice*im_qty) AS result FROM imported");
$tal_3 = mysqli_fetch_assoc($query_3);
$query_4 = mysqli_query($conn, "SELECT * FROM `user`");
$tal_4 = mysqli_num_rows($query_4);
$query_5 = mysqli_query($conn, "SELECT SUM((p2.prod_price-p2.prod_sprice)*p1.or_qty) AS result FROM orders as p1 INNER JOIN product as p2 ON p1.prod_id = p2.prod_id;");
$tal_5 = mysqli_fetch_assoc($query_5);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Charts</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: "NotoSansLao";
            src: url("font/NotoSansLao-VariableFont_wdth\,wght.ttf") format("woff2"),
                url("font/NotoSansLao-VariableFont_wdth\,wght.ttf") format("woff"),
                url("font/NotoSansLao-VariableFont_wdth\,wght.ttf") format("truetype");
            /* Add other font properties as needed, e.g., font-weight, font-style */
        }

        * {
            font-family: "NotoSansLao", sans-serif;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                ຈຳນວນໂຕທັງໝົດ</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $tal_d ?>
                                                ໂຕະ
                                            </div>
                                        </div>
                                        <div class="col-auto">

                                            <i class="fas fa-table fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                ໂຕະວ່າງ</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $tal_l ?>
                                                ໂຕະ
                                            </div>
                                        </div>
                                        <div class="col-auto">

                                            <i class="fas fa-table fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                ຈຳນວນເງິນທີ່ໄດ້</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo number_format($tal_2['monye']) ?>
                                                ກີບ
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-car fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                ຈຳນວນພະນັກງານທັງໝົດ</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $tal_4 ?>
                                                ຄົນ
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                ຕົ້ນທຶນ</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo number_format($tal_3['result']) ?>
                                                ກີບ
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-table fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                ກຳໄລ
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo number_format($tal_5['result']) ?>
                                                ກີບ
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-table fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->

                    </div>
                    <hr><!-- /.container-fluid -->
                    <div class="row">
                        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                            <div class="col-xl-3 col-md-2 mb-4">
                                <a href="page/orders/select_orders.php?select_id=<?php echo $row['ta_id'] ?>"
                                    class=" text-decoration-none">
                                    <div
                                        class="card <?php if ($row['ta_status'] == "Full") { ?>  border-left-danger <?php } else { ?> border-left-success <?php } ?> shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold  <?php if ($row['ta_status'] == "Full") { ?> text-danger <?php } else { ?>
                                              text-success <?php } ?> text-uppercase mb-1">
                                                        <?php if ($row['ta_status'] == "Full") { ?> ໂຕະເຕັມ
                                                        <?php } else { ?>
                                                            ໂຕະວ່າງ
                                                        <?php } ?>
                                                    </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                <?php echo $row['ta_name'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>

                </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="js/demo/datatables-demo.js"></script>
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="js/sweetalert2.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
        <script src="js/demo/chart-bar-demo.js"></script>
        <script>
            $(document).ready(function () {
                $(".goout").click((e) => {
                    var car_id = e.target.id;
                    $(e.target).addClass("d-none"); // Add "d-none" class to the clicked button
                    $(e.target).siblings(".goin").removeClass("d-none");
                    var button2 = $(e.target).siblings(".goin");
                    $.ajax({
                        type: "post",
                        url: "update_car.php",
                        data: {
                            car_id
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "ອະນຸຍາດສຳເລັດ",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            setTimeout(() => {
                                window.location = "charts.php"
                            }, 1500)
                        }
                    });
                });

                $(".goin").click((e) => {
                    var car_id = e.target.id;
                    $(e.target).addClass("d-none"); // Add "d-none" class to the clicked button
                    $(e.target).siblings(".goout").removeClass("d-none");
                    var button2 = $(e.target).siblings(".goin");
                    $.ajax({
                        type: "post",
                        url: "update_car_in.php",
                        data: {
                            car_id
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "ເລິ່ມຕົ້ນສຳເລັດ",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            setTimeout(() => {
                                window.location = "charts.php"
                            }, 1500)
                        }
                    });
                });
            })
        </script>

</body>

</html>