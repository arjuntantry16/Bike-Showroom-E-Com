<?php
    include 'dbh.inc.php';

    if(isset($_POST['login-submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(empty($username) || empty($password)) {
            header("Location:../login.php?Login=emptyfields&uname=$username");
        }else {
           $sql = "select * from client where clientusername='$username';";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
           if(password_verify($password,$row['clientpassword'])){
                    session_start();
                    $_SESSION['username'] =$username;
                    header("Location:../index.php?Login=Successful");
               }else {
                header("Location:../login.php?Login=WrongPassword&uname=$username");
               }
            } else {
                header("Location:../login.php?Login=Usernotfound&uname=$username");
                exit();
            }
        }
    }else {
        header("Location:../login.php?Login=NotSuccessfull");
        exit();
    }
?>