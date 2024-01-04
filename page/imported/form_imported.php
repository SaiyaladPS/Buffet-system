<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';

$select_product = mysqli_query($conn, "SELECT * FROM product");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SB Admin 2 - Buttons</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.min.css">
    <style>
    @font-face {
        font-family: "NotoSansLao";
        src: url("../../font/NotoSansLao-VariableFont_wdth\,wght.ttf") format("woff2"),
            url("../../font/NotoSansLao-VariableFont_wdth\,wght.ttf") format("woff"),
            url("../../font/NotoSansLao-VariableFont_wdth\,wght.ttf") format("truetype");
        /* Add other font properties as needed, e.g., font-weight, font-style */
    }

    body {
        font-family: "NotoSansLao", sans-serif;
    }

    .coutnform {
        transform: translateX(-50%);
        left: 50%;
        position: relative;
        border-radius: 20px;
    }

    .coutomcheck {

        transform: translateY(-50%);
        top: 50%;
        position: relative;
    }

    .profile-container {
        text-align: center;
    }

    .profile-picture {
        position: relative;
        display: inline-block;
        left: 50%;
        transform: translateX(-50%);
    }

    .img {
        width: 180px;
        height: 150px;
        object-fit: cover;
        border: 2px solid #007bff;
        margin: 0 auto;
    }

    input[type="file"] {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .label {
        display: block;
        margin-top: 10px;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }

    .label:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div class="my-auto">
        <div class="row">
            <?php while ($rows = mysqli_fetch_assoc($select_product)) { ?>
            <div class="card mx-2" style="width: 18rem;">
                <img src="../../img/<?php echo $rows['prod_img'] ?>" class="card-img-top img" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $rows['prod_name'] ?>
                    </h5>
                    <p class="card-text">ລາຄາ:
                        <?php echo $rows['prod_price'] ?>
                    </p>
                    <button id="<?php echo $rows['prod_id'] ?>" class="btn btn-primary select-pro"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        ເພິ່ມ
                        <?php echo $rows['prod_name'] ?>ເຂົ້າ
                    </button>
                </div>
            </div>
            <?php } ?>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">ນຳເຂົ້າສິນຄ້າ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="profile-picture">
                            <img src="../../img/product.png" class="img" alt="Default Avatar" id="preview">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">ຈຳນວນ</label>
                            <input type="number" class="form-control" name="" id="im_qty" aria-describedby="helpId"
                                placeholder="" />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">ລາຄາຊື້</label>
                            <input type="number" class="form-control" name="" id="im_sprice" aria-describedby="helpId"
                                placeholder="" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ຍົກເລີກ</button>
                        <button type="button" class="btn btn-primary" id="sell">ເພິ່ມເຂົ້າ</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <script src="../../js/sweetalert2.js"></script>
    <script>
    $(document).ready(function() {
        $(".select-pro").click((e) => {
            var prod_id = e.target.id;
            $.ajax({
                type: "post",
                url: "select_prod.php",
                data: {
                    prod_id
                },
                success: function(response) {
                    var data = JSON.parse(response)
                    console.log(data)
                    $("#preview").attr("src", `../../img/${data.prod_img}`);
                    $("#sell").click(() => {
                        var prod_id = data.prod_id
                        var im_img = data.prod_img;
                        var im_name = data.prod_name;
                        var im_qty = $("#im_qty").val();
                        var im_sprice = $("#im_sprice").val();

                        if (im_qty == "") {
                            Swal.fire({
                                icon: "error",
                                title: "ກະລຸນາປ້ອນຈຳນວນນຳເຂົ້າ",
                                confirmButtonText: "ຕົກລົງ"
                            });
                        } else if (im_sprice == "") {
                            Swal.fire({
                                icon: "error",
                                title: "ກະລຸນາປ້ອນລາຄາຊື້",
                                confirmButtonText: "ຕົກລົງ"
                            });
                        } else {
                            var dataSend = {
                                prod_id,
                                im_img,
                                im_name,
                                im_qty,
                                im_sprice
                            }
                            $.ajax({
                                type: "post",
                                url: "insert_imported.php",
                                data: dataSend,
                                success: function(response) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "ນຳເຂົ້າສິນຄ້າສຳເລັດ",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                    setTimeout(() => {
                                        window.location =
                                            "select_imported.php"
                                    }, 1500);
                                }
                            });
                        }
                    })
                }
            });
        })

    });
    </script>
</body>

</html>