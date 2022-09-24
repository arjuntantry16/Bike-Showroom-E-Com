<?php
include_once 'dbh.inc.php';
    if(isset($_POST['sales-submit'])){
        $salesid = $_POST['sales-select'];
        $status = $_POST['status-select'];
        $sql = "update sales set deliverystatus='$status' where salesid='$salesid';";
        $result = mysqli_query($conn,$sql);
        header("location:../adminsales.php?update=$status");
        exit();
    }else{
        header("index.php?pagenotaccessible");
        exit();
    }