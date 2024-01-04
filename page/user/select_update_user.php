<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
// todo SELECT UPDATE
$select_id = $_GET['select_id'];
$sql_select = "SELECT * FROM user WHERE us_id = '" . $select_id . "'";
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
            width: 150px;
            height: 150px;
            border-radius: 50%;
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
                <input type="hidden" id="us_id" value="<?php echo $rows_select['us_id'] ?>">
                <div class="profile-picture">
                    <img src="../../img/<?php echo $rows_select['us_img'] ?>" class="img" alt="Default Avatar"
                        id="preview">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">ຊື່ແລະນາມສະກຸນ</label>
                        <input type="text" class="form-control" id="us_name"
                            value="<?php echo $rows_select['us_name'] ?>" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">ເບີໂທ</label>
                        <input type="number" class="form-control" value="<?php echo $rows_select['us_tel'] ?>"
                            id="us_tel" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">ເງິນເດືອນ</label>
                        <input type="number" value="<?php echo $rows_select['us_salary'] ?>" class="form-control"
                            id="us_salary">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">ຊື່ຜູ້ນຳໃຊ້</label>
                        <input type="text" class="form-control" value="<?php echo $rows_select['us_username'] ?>"
                            id="us_username">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">ສະຖານະ</label>
                        <select class="form-select form-control form-select-lg" name="" id="us_status">
                            <option selected hidden value="<?php echo $rows_select['us_status'] ?>">
                                <?php if ($rows_select['us_status'] == "admin") { ?> ຜູ້ບໍລິຫານ
                                <?php } else { ?>
                                    ພະນັກງານ
                                <?php } ?>
                            </option>
                            <option value="admin">ຜູ້ບໍລິຫານ</option>
                            <option value="user">ພະນັກງານ</option>
                        </select>
                    </div>

                </div>
            </div>


            <button type="submit" class="btn btn-primary ">ບັນທືກ</button>
            <button type="reset" class="btn btn-danger ">ລ້າງ</button>
            <a href="select_user.php" class="btn btn-success ">ຂໍ້ມູນ</a>
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
                var us_name = $("#us_name").val()
                var us_tel = $("#us_tel").val()
                var us_salary = $("#us_salary").val()
                var us_username = $("#us_username").val()
                var us_status = $("#us_status").val()
                var us_id = $("#us_id").val()

                if (us_name == "") {
                    Swal.fire({
                        icon: "error",
                        title: "ກະລຸນາປ້ອນຊື່",
                        confirmButtonText: "ຕົກລົງ"
                    });
                } else if (us_tel == "") {
                    Swal.fire({
                        icon: "error",
                        title: "ກະລຸນາປ້ອນເບີໂທ",
                        confirmButtonText: "ຕົກລົງ"
                    });
                } else if (us_salary == "") {
                    Swal.fire({
                        icon: "error",
                        title: "ກະລຸນາປ້ອນເງິນເດືອນພະນັກງານ",
                        confirmButtonText: "ຕົກລົງ"
                    });
                } else if (us_username == "") {
                    Swal.fire({
                        icon: "error",
                        title: "ກະລຸນາປ້ອນຊື່ຜູ້ນຳໃຊ",
                        confirmButtonText: "ຕົກລົງ"
                    });
                } else if (us_status == "") {
                    Swal.fire({
                        icon: "error",
                        title: "ກະລຸນາປ້ອນເລືອກສະຖານະ",
                        confirmButtonText: "ຕົກລົງ"
                    });
                } else {

                    var formData = new FormData();

                    formData.append("us_name", us_name);
                    formData.append("us_tel", us_tel);
                    formData.append("us_salary", us_salary);
                    formData.append("us_username", us_username);
                    formData.append("us_status", us_status);
                    formData.append("us_id", us_id)
                    // chekc data
                    $.ajax({
                        type: "post",
                        url: "update_user.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "ແກ້ໄຂ້ຂໍ້ມູນສຳເລັດ",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            setTimeout(() => {
                                window.location =
                                    "select_user.php"
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

            reader.onloadend = function () {
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