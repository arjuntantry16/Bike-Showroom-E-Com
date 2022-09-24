<?php
    include_once 'dbh.inc.php';

    if(isset($_POST['password-submit'])){
    session_start();
    $email = $_SESSION['email'];
    $sql = "select * from client where clientemail='$email';";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        $newpassword=$_POST['newpassword'];
        $confirmpassword=$_POST['retypenewpassword'];
        if(empty($newpassword)||empty($confirmpassword)){
            header("location:../changepassword.php?error=emptyfields");
            exit();
        }elseif((strlen($newpassword) && strlen($confirmpassword)) < 7){
            header("location:../changepassword.php?error=passwordisweak");
            exit();
        }else{
        if($newpassword !== $confirmpassword){
            header("location:../changepassword.php?error=passwordsdonotmatch"); 
            exit();
        }else{
            $hashedpass = password_hash($newpassword,PASSWORD_DEFAULT);
        $sqlupdate = "update client set clientpassword='$hashedpass' where clientemail='$email';";
        mysqli_query($conn,$sqlupdate);
        header("location:../login.php?passwordchange=success");
        exit();
        }
    }
    }
    }else{
        header("location:../changepassword.php?pagenotaccessible");
        exit();
    }
