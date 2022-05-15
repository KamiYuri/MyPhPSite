<?php
    require '../session.php';
    
    if(!isset($_SESSION["username"])){
        header("Location:../login.php");
    }

    if(!isset($_GET["id"])){
        header("Location:./post.php");
    }
    
    $id = $_GET["id"];
    $user_id = $_SESSION['id'];

    require_once '../connect.php';

    $sql = "SELECT * FROM post WHERE id = '$id' AND owner_id = '$user_id'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if(empty($row)){
        header("Location:./post.php");
        return;
    }

    $sql = "DELETE FROM post WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION["message"] = "Xóa bài viết thành công.";

    } else{
        $_SESSION["message"] = "Xóa bài viết thất bại.";
    }
    $conn->close();
    header("Location:./post.php");
?>