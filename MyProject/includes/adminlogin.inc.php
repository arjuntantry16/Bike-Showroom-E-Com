<?php

include_once 'dbh.inc.php';

if(isset($_POST['login-submit'])){
    $password = $_POST['password'];
    $username = $_POST['username'];
    if(empty($password) || empty($username)){
        header("Location:../index.php?Login=emptyfields&uname=$username");
    }else{
    if($_POST['username'] === "admin"){
        $password = $_POST['password'];
        $sql="select * from admin;";
        $result=mysqli_query($conn,$sql);
        $rows=mysqli_fetch_assoc($result);
        if(password_verify($password,$rows['password'])){
            session_start();
            $_SESSION['username'] = "admin";
            header("Location:../index.php?Login=adminloginsuccess");
        }else {
            header("Location:../adminlogin.php?Login=WrongPassword&uname=$username");
        }
    }else{
        header("Location:../adminlogin.php?Login=Usernotfound&uname=$username");    
    }
    }
}else {
    header("Location:../adminlogin.inc.php?clicksubmit");
}