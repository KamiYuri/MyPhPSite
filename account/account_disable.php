<?php
    require './middleware.php';
    
    $id = $_GET["id"];
    $user_id = $_SESSION['id'];

    require_once '../connect.php';

    $query = "SELECT * FROM user WHERE id = $id AND type = '0'";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if(empty($row)){
        header("Location:./account.php");
        return;
    }

    $query = "UPDATE user SET type = -1 WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        $_SESSION["message"] = "Vô hiệu hóa tài khoản thành công.";
    } else{
        $_SESSION["message"] = "Vô hiệu hóa tài khoản thất bại.";
    }
    $conn->close();
    header("Location:./account.php");
?>