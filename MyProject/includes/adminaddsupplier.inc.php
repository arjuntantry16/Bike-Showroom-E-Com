<?php 
    include_once 'dbh.inc.php';
    session_start();

    if(isset($_POST['supplier-btn'])){
        $name=$_POST['name'];
        $brand=$_POST['brand'];
        $contactno=$_POST['contactno'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        if(empty($name) || empty($brand) || empty($contactno) || empty($email) || empty($address)){
            header("location:../adminaddsupplier.php?error=emptyfields");
        exit();
        }else{
            $contactlength = strlen($contactno);
            if(!preg_match("/[0-9]/",$contactno)){
                header("location:../adminaddsupplier.php?error=invalidno");
                exit(); 
            }else{
                if($contactlength == 10){
                    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                        header("location:../adminaddsupplier.php?error=invalidemail");
                        exit();
                    }else{
                        $sql = "insert into supplier (suppliername,supplierbrand,suppliercontactno,supplieremail,supplieraddress) values ('$name','$brand','$contactno','$email','$address');";
                        mysqli_query($conn,$sql);
                        header("location:../adminaddsupplier.php?insert=success");
                        exit();
                    }
                }else{
                header("location:../adminaddsupplier.php?error=invalidno");
                exit(); 
                }
            }
        }
    }else{
        header("location:../adminaddsupplier.php?pagenotaccessible");
        exit();
    }