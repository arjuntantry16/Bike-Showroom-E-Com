<?php
    include_once 'dbh.inc.php';
    session_start();
    if(isset($_SESSION['username'])){
    $text = $_GET['search'];
    $username = $_SESSION['username'];
    $bikeid = $_GET['bikeid'];
    $pagename = $_GET['pagename'];
    $brandname = $_GET['name'];
    $sqlquery = "select * from cart where bikeid='$bikeid' AND clientusername='$username';";
    $result1=mysqli_query($conn,$sqlquery);
    if(mysqli_num_rows($result1) > 0){
        header("Location:../$pagename.php?operation=alreadyincart&name=$brandname&bikeid=$bikeid&search=$text"); 
    }else{
    $sql = "insert into cart (bikeid,clientusername) values ('$bikeid','$username');";
    mysqli_query($conn,$sql);
    header("Location:../$pagename.php?operation=added&name=$brandname&bikeid=$bikeid&search=$text");
    }
    }else {
        header("Location:../login.php");
    }