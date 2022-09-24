<?php

    include_once 'dbh.inc.php';

    if(isset($_POST['submit'])){
        $prevpassword = $_POST['previouspassword'];
        $newpassword = $_POST['newpassword'];
        $confirmpassword = $_POST['confirmpassword'];
        $prevpassword = $_POST['previouspassword'];
        if(empty($prevpassword) || empty($newpassword) || empty($confirmpassword)){
            header("Location:../adminpasswordchange.php?error=emptyfields");
            exit();
        }else {
            $sql = "select * from admin;";
            $result = mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $id = $row['id'];
            $hashedpas = $row['password'];
            if(password_verify($prevpassword,$row['password'])){
                 if($newpassword === $confirmpassword){
                    $query = "delete from admin where id=$id;";
                    mysqli_query($conn,$query);
                    $newhashedpass=password_hash($newpassword,PASSWORD_DEFAULT);
                    $insertquery = "insert into admin (password) values ('$newhashedpass');";
                    mysqli_query($conn,$insertquery);
                    header("Location:../adminpasswordchange.php?passchange=success");
                }else {
                    header("Location:../adminpasswordchange.php?error=passdontmatch");
                }
            }else {
                header("Location:../adminpasswordchange.php?error=prevpasswrong");
            }
        }
    }else {
        header("Location:../adminpasswordchange.php?passchange=notsuccessful");
        exit();
    }