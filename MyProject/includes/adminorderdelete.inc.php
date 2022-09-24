<?php
    include_once 'dbh.inc.php';
    if(isset($_GET['orderid'])){
        $orderid=$_GET['orderid'];
        $sql="delete from porder where orderid='$orderid';";
        mysqli_query($conn,$sql);
        header("location:../adminorder.php?delete=success");
        exit();
    }else{
        header("location:../adminorder.php?pagenoaccessible");
        exit();
    }