<?php
    include_once 'dbh.inc.php';
        $bikeid=$_GET['bikeid'];
        $sql = "delete from stock where bikeid='$bikeid';";
        mysqli_query($conn,$sql);
        header("location:../admindelete.php?delete=success");