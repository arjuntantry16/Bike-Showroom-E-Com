<?php 
    include_once 'dbh.inc.php';
    session_start();
    if(isset($_SESSION['username'])){
    $text = $_GET['search'];
    $username=$_SESSION['username'];
    $bikeid = $_GET['bikeid'];
    $brandname = $_GET['name'];
    $pagename = $_GET['pagename'];
    $sql = "delete from cart where bikeid='$bikeid' AND clientusername='$username';";
    mysqli_query($conn,$sql);
    header("Location:../$pagename.php?operation=removed&name=$brandname&bikeid=$bikeid&search=$text");
    }else {
        header("Location:../login.php");
    }