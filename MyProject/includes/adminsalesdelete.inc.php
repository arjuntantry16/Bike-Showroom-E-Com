<?php
    include_once 'dbh.inc.php';
    
            $salesid=$_GET['salesid'];
            $sql = "delete from sales where salesid='$salesid';";
            mysqli_query($conn,$sql);
            header("location:../adminsales.php?delete=success");
        
    