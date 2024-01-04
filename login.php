<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- fonts -->
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

        .bg-image {
            background-image: url("img/p1et1fi6bij271fql10t91ecuujne4.png");
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">ຮ້ານຍິ້ມຍິ້ມ ❤</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username"
                                                aria-describedby="emailHelp" placeholder="ຊື່ຜູ້ໃຊ້..." />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="ລະຫັດຜ່ານ" />
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" />
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            ເຂົ້າສູ່ລະບົບ
                                        </button>
                                        <hr />
                                    </form>
                                    <hr />
                                    <div class="text-center">
                                        <a class="small" href="#">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="#">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/sweetalert2.js"></script>

    <script>
        $(document).ready(function () {
            $(".user").submit((e) => {
                e.preventDefault()
                var username = $("#username").val()
                var password = $("#password").val()
                if (username == "") {
                    Swal.fire({
                        icon: "error",
                        title: "ກະລຸນາປ້ອນຊື່ຜູ້ໃຊ້",
                        confirmButtonText: "ຕົກລົງ"
                    });
                } else if (password == "") {
                    Swal.fire({
                        icon: "error",
                        title: "ກະລຸນາປ້ອນຊື່ລະຫັດຜ່ານ",
                        confirmButtonText: "ຕົກລົງ"
                    });
                } else {
                    // todo check login Trune
                    $.ajax({
                        type: "post",
                        url: "check_userlogin.php",
                        data: {
                            username,
                            password
                        },

                        success: function (response) {
                            var data = JSON.parse(response);
                            // todo check users password and username
                            if (data >= '1') {
                                $.ajax({
                                    type: "post",
                                    url: "check_user_status.php",
                                    data: {
                                        username,
                                        password
                                    },
                                    success: function (response) {
                                        // todo select user passowrd and usernmae
                                        var data = JSON.parse(response);
                                        if (data.us_status == "admin") {
                                            localStorage.setItem("username", data
                                                .us_name)
                                            Swal.fire({
                                                icon: "success",
                                                title: "admin ເຂົ້າສູ່ລະບົບສຳເລັດ",
                                                showConfirmButton: false,
                                                timer: 1500,
                                            });
                                            setTimeout(() => {
                                                window.location =
                                                    "admin.php"
                                            }, 1500)
                                        } else {
                                            localStorage.setItem("username", data
                                                .us_name)
                                            Swal.fire({
                                                icon: "success",
                                                title: "user ເຂົ້າສູ່ລະບົບສຳເລັດ",
                                                showConfirmButton: false,
                                                timer: 1500,
                                            });
                                            setTimeout(() => {

                                                window.location =
                                                    "users.php"
                                            }, 1500)
                                        }
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "ລະຫັດຜ່ານ ຫຼຶ ຊື່ຜູ້ໃຊ້ ບໍຖືກຕ້ອງ",
                                    confirmButtonText: "ຕົກລົງ"
                                });
                            }
                        }
                    });
                }
            })
        })
    </script>
</body>

</html>