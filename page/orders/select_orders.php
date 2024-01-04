<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
// todo SELECT UPDATE
$select_id = isset($_GET['select_id']) ? $_GET['select_id'] : $_SESSION['table'];
$sql_select = "SELECT * FROM `table` WHERE ta_id = '" . $select_id . "'";
$query_select = mysqli_query($conn, $sql_select);
$rows_select = mysqli_fetch_assoc($query_select);

$_SESSION['table'] = $select_id;

$select_product = mysqli_query($conn, "SELECT * FROM product");

$sql_select_full = mysqli_query($conn, "SELECT * FROM bil WHERE ta_id = '" . $select_id . "'");
$row_check = mysqli_num_rows($sql_select_full);
$sql_select_full_in = mysqli_query($conn, "SELECT * FROM `bil` as p1 INNER JOIN `product` as p2 ON p1.prod_id = p2.prod_id INNER JOIN `table` as p3 ON p1.ta_id = p3.ta_id WHERE p3.ta_id = '" . $select_id . "'");
$sql_pice = mysqli_query($conn, "SELECT SUM(p2.prod_price*p1.bi_qty) as toal FROM `bil` as p1 INNER JOIN `product` as p2 ON p1.prod_id = p2.prod_id WHERE p1.ta_id = '" . $select_id . "'");
$row_pice = mysqli_fetch_assoc($sql_pice);
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
                    <button id="<?php echo $rows['prod_id'] . "," . $rows_select['ta_id'] ?>"
                        class="btn btn-primary select-pro">
                        <?php echo $rows['prod_name'] ?>ເພິ່ມເຂົ້າ
                    </button>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="offcanvas offcanvas-end <?php if ($row_check > 0) { ?>show<?php } ?>" data-bs-scroll="true"
            data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">ໂຕະທີ່
                    <?php echo $rows_select['ta_name'] ?>
                </h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body overflow-scroll">
                <table class="table table-dark table-striped">
                    <thead>
                        <th>ຮູບພາບ</th>
                        <th>ຊື່</th>
                        <th>ລາຄາ</th>
                        <th>ຈຳນວນ</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php while ($rows = mysqli_fetch_assoc($sql_select_full_in)) { ?>
                        <tr>
                            <td><img width="50" height="70" src="../../img/<?php echo $rows['prod_img'] ?>" /></td>
                            <td>
                                <?php echo $rows['prod_name'] ?>
                            </td>
                            <td>
                                <?php echo $rows['prod_price'] ?>
                            </td>
                            <td>
                                <?php echo $rows['bi_qty'] ?>
                            </td>
                            <td><button class=" btn btn-danger btnDelete_out" data-id="<?php echo $rows['bi_id'] ?>"
                                    id="<?php echo $rows['bi_qty'] . "," . $rows['prod_id'] ?>">Del</button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tbody id="cart">

                    </tbody>
                </table>
            </div>

            <p class=" bg-danger text-center py-3 text-white fs-4 ">Total:<span id="total">
                    <?php echo $row_pice['toal'] ?>
                </span>
                ກີບ</p>
            <a href="#" id="save" class="btn btn-warning ">ຮັບອໍເດີເພິ່ມ</a>
            <button type="button" id="sell" class="btn btn-success ">ອອກບິນ</button>
        </div>
        <div id="Bill"></div>
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
    $(document).ready(function() {
        let cart = [];
        let total = <?php echo json_decode($row_pice['toal'] ? $row_pice['toal'] : 0); ?>;

        $(".btnDelete_out").click((event) => {
            var bi_id = $(event.currentTarget).data("id");
            var dataget = $(event.currentTarget).attr("id");
            var array = dataget.split(",");
            var prod_id = array[1];
            var prod_qty = array[0];
            Swal.fire({
                title: "ຕ້ອງການລົບຫຼຶບໍ່?",
                text: "ຖ້າຕ້ອງການກົດທີຢືນຢັນ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ຢືນຢັນ",
                cancelButtonText: "ຍົກເລິກ"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "delete_bill.php",
                        data: {
                            bi_id,
                            prod_id,
                            prod_qty
                        },
                        success: function(response) {
                            if (response == 200) {
                                Swal.fire({
                                    icon: "success",
                                    title: "ລົບຂໍ້ມູນສຳເລັດ",
                                    showConfirmButton: false,
                                    timer: 800,
                                });
                                setTimeout(() => {
                                    window.location =
                                        "select_orders.php"
                                }, 800);
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "ບໍ່ສາມາດລົບໄດ້",
                                    text: "ເນືອງຈາກອາດເກີດຂໍ້ຜິດພາດບາງຢ່າງ",
                                    confirmButtonText: "ຕົກລົງ"
                                });
                            }
                        }
                    });
                }
            });


        })

        $("#save").click(() => {
            Swal.fire({
                icon: "success",
                title: "ຮັບອໍເດີທີ່ໂຕະໃຫມ່",
                showConfirmButton: false,
                timer: 1500,
            });
            setTimeout(() => {
                window.location = "../../charts.php"
            }, 1500)

        })
        $("#sell").click(() => {

            var ta_id = <?php echo json_encode($select_id); ?>;
            $.ajax({
                type: "post",
                url: "select_table.php",
                data: {
                    ta_id: ta_id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var datacout = data.length
                    $.ajax({
                        type: "get",
                        url: "print.php",
                        data: {
                            data: data,
                            count: data.length,
                        },
                        success: function(response) {
                            var printWindow = window.open("", "_blank");
                            printWindow.document.write(response);
                            printWindow.document.close();

                            // Wait for the content to be fully loaded before printing
                            printWindow.onload = function() {
                                // Print the content
                                printWindow.print();
                            };
                            window.location = "../../charts.php";
                        }
                    });
                    cart.forEach((item) => {
                        empty()

                    })
                }
            });
        })

        $('.select-pro').click(function(e) {
            // Prevent the default action of the click event
            e.preventDefault();
            var id = $(this).attr('id');
            var dataArray = id.split(",");
            var elementId = dataArray[0]
            var tableId = dataArray[1]
            $.ajax({
                type: "post",
                url: "select_product_orders.php",
                data: {
                    id: elementId
                }, // Modify data as needed

                success: function(response) {
                    let data = JSON.parse(response)
                    if (data.prod_qty <= 0) {
                        Swal.fire({
                            icon: "error",
                            title: "ສິນຄ້າໝົດສະຕ໋ອກ",
                            confirmButtonText: "ຕົກລົງ"
                        });
                    } else {
                        var prod_id = data.prod_id;
                        $.ajax({
                            type: "post",
                            url: "delete_qty_product.php",
                            data: {
                                prod_id
                            },
                            success: function(response) {
                                localStorage.setItem('prod_name', data
                                    .prod_name)
                                const existingProduct = cart.find(item => item
                                    .prod_id ===
                                    elementId);
                                if (existingProduct) {
                                    existingProduct.qty += 1;
                                } else {
                                    cart.push({
                                        prod_id: data.prod_id,
                                        prod_name: data.prod_name,
                                        prod_price: data.prod_price,
                                        prod_img: data.prod_img,
                                        qty: 1
                                    });
                                }
                                total += parseFloat(data.prod_price)
                                updateCartUI();
                            }
                        });
                    }
                }
            });

            function formatNumberWithCommas(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            function deleteCartItem(bookId) {
                const indexToDelete = cart.findIndex(item => item.prod_id === bookId);

                if (indexToDelete !== -1) {
                    total -= cart[indexToDelete].prod_price * cart[indexToDelete].qty;
                    cart.splice(indexToDelete, 1);
                    updateCartUI()
                }
            }

            function updateCartUI() {
                // Clear existing cart items
                $('#cart').empty();

                // Add cart items to the UI
                cart.forEach(function(item) {
                    $('#cart').append(
                        `<tr><td><img width="50" height="70" src="../../img/${item.prod_img}"/></td><td>${item.prod_name}</td><td>${item.prod_price}</td><td>${item.qty}</td><td><button class=" btn btn-danger btnDelete" data-id="${item.prod_id}" id="${item.qty}">Del</button></td></tr>`
                    );
                });
                $(".btnDelete").click((event) => {
                    var idToDelete = $(event.currentTarget).data("id");
                    // Now you can use idToDelete to perform your delete operation
                    var qty = $(event.currentTarget).attr("id")
                    var Id = idToDelete.toString()
                    deleteCartItem(Id)
                    $.ajax({
                        type: "post",
                        url: "update_qty_product.php",
                        data: {
                            Id,
                            qty
                        },
                        success: function(response) {

                        }
                    });
                })

                // Update total
                $('#total').text(formatNumberWithCommas(total.toFixed(2)));


                $("#save").click(() => {

                    $.ajax({
                        type: "post",
                        url: "insert_order.php",
                        data: {
                            data: cart,
                            count: cart.length,
                            total: total,
                            ta_id: <?php echo $rows_select['ta_id'] ?>
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: "success",
                                title: "ຮັບອໍເດີທີ່ໂຕະໃຫມ່",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            setTimeout(() => {
                                window.location = "../../charts.php"
                            }, 1500)
                        }
                    });
                    cart.forEach((item) => {
                        empty()
                    })
                })


            }

            let dataM = localStorage.getItem('prod_name');
            if (dataM != "") {
                $('.offcanvas-end').addClass('show')
                $('.offcanvas-end').css({
                    'visibility': 'visible',
                })
            }
            $('.btn-close').click(() => {
                $('.offcanvas-end').removeClass('show').css({
                    'visibility': 'hidden'
                })
            })
        });


    });
    </script>
</body>

</html>