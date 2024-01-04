<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
// todo SELECT UPDATE
$select_id = $_GET['select_id'];
$sql_select = "SELECT * FROM product WHERE prod_id = '" . $select_id . "'";
$query_select = mysqli_query($conn, $sql_select);
$rows_select = mysqli_fetch_assoc($query_select);
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
    }

    .img {
        width: 180px;
        height: 150px;

        object-fit: cover;
        border: 2px solid #007bff;
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
        <form class=" w-50 h-50 bg-gradient-primary text-white px-5 py-5 coutnform rounded-4 mt-4" id="form_province">
            <div class="profile-container">
                <div class="profile-picture">
                    <img src="../../img/<?php echo $rows_select['prod_img'] ?>" class="img" alt="Default Avatar"
                        id="preview">
                </div>
            </div>
            <input type="hidden" id="prod_id" value="<?php echo $rows_select['prod_id'] ?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ຊື່ສິນຄ້າ</label>
                <input type="text" class="form-control" id="prod_name" value="<?php echo $rows_select['prod_name'] ?>"
                    aria-describedby=" emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ລາຄາ</label>
                <input type="text" class="form-control" value="<?php echo $rows_select['prod_price'] ?>" id="prod_price"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">ໜາຍເຫດ</label>
                <input type="text" class="form-control" id="prod_remak"
                    value="<?php echo $rows_select['prod_remak'] ?>">
            </div>
            <button type="submit" class="btn btn-primary ">ບັນທືກ</button>
            <button type="reset" class="btn btn-danger ">ລ້າງ</button>
            <a href="select_product.php" class="btn btn-success ">ຂໍ້ມູນ</a>
        </form>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <script src="../../js/sweetalert2.js"></script>

    <script>
    $(document).ready(() => {
        $('#form_province').submit((e) => {
            e.preventDefault()
            var prod_id = $("#prod_id").val()
            var prod_name = $("#prod_name").val()
            var prod_price = $("#prod_price").val()
            var prod_remak = $("#prod_remak").val()

            if (prod_name == "") {
                Swal.fire({
                    icon: "error",
                    title: "ກະລຸນາປ້ອນຊື່ສິນຄ້າ",
                    confirmButtonText: "ຕົກລົງ"
                });
            } else if (prod_price == "") {
                Swal.fire({
                    icon: "error",
                    title: "ກະລຸນາປ້ອນລາຄາ",
                    confirmButtonText: "ຕົກລົງ"
                });
            } else {

                var formData = new FormData();
                formData.append("prod_id", prod_id);
                formData.append("prod_name", prod_name);
                formData.append("prod_price", prod_price);
                formData.append("prod_remak", prod_remak);
                // chekc data
                $.ajax({
                    type: "post",
                    url: "update_product.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "ແກ້ໄຂ້ຂໍ້ມູນສຳເລັດ",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        setTimeout(() => {
                            window.location =
                                "select_product.php"
                        }, 1500);
                    }
                });
            }
        })
    })

    function previewImage(input) {
        var preview = document.getElementById('preview');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "default-avatar.png"; // Display default image if no file selected
        }
    }
    </script>
</body>

</html>