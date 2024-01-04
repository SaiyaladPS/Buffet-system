<?php
session_start();

if ($_SESSION['username'] == "") {
    header("location: ../../404.php");
}
require '../../db/connect.php';
$prod_name = $_POST['prod_name'];
$prod_price = $_POST['prod_price'];
$prod_remak = $_POST['prod_remak'];

// Check if the file was uploaded without errors
if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
    $targetDir = "../../img/"; // Specify the directory where you want to store uploaded images
    $targetFile = $targetDir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo json_encode("File is not an image.");
        $uploadOk = 0;
    }

    // Check if the file already exists
    if (file_exists($targetFile)) {
        echo json_encode("Sorry, the file already exists.");
        $uploadOk = 0;
    }

    // Check file size (adjust the limit as needed)
    if ($_FILES["img"]["size"] > 500000) {
        echo json_encode("Sorry, your file is too large.");
        $uploadOk = 0;
    }

    // Allow certain file formats (adjust the formats as needed)
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo json_encode("Sorry, only JPG, JPEG, PNG, and GIF files are allowed.");
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo json_encode("Sorry, your file was not uploaded.");
    } else {
        // Move the file to the specified directory
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
            // Insert image information into the database
            $sql = "INSERT INTO `product`(`prod_img`, `prod_name`, `prod_price`, `prod_qty`, `prod_remak`) 
            VALUES ('" . basename($targetFile) . "','" . $prod_name . "','" . $prod_price . "','0','" . $prod_remak . "')";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(1);
            } else {
                echo json_encode("Error: " . $sql . "<br>" . mysqli_error($conn));
            }
        } else {
            echo json_encode("Sorry, there was an error uploading your file.");
        }
    }
} else {
    echo json_encode("No file was uploaded.");
}

?>