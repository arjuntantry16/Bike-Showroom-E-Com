<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql = "delete from supplier where supplierid='$id';";
        mysqli_query($conn,$sql);
        header("location:../adminaddsupplier.php?delete=success");
        exit();
    }else{
        header("location:../adminaddsupplier.php?pagenotaccessible");
        exit();
    }