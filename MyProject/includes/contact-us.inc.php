<?php
    include_once 'dbh.inc.php';
    if(isset($_POST['contact-us-btn'])){
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        if(empty($email)){
            header("Location:../index.php?error=emptyfields");
            exit();
            } else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                header("Location:../index.php?error=invalidemail");
                exit();
            }else{
                $sql = "select * from client where clientemail='$email';";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result); 
                    $companyemail = "select * from companydetails;";
                    $resulte = mysqli_query($conn,$companyemail);
                    $rowemail=mysqli_fetch_assoc($resulte);
                    $cemail = $rowemail['companyemail'];
                    $to_email = "arjuntantry99@gmail.com";
                   
                    $body = $message;
                    $from_header="From: '$email'";
   
                    if(mail($to_email,$subject,$body,$from_header)){
                        session_start();
                        $_SESSION['code']=$code;
                        $_SESSION['email'] = $email;
                        header("Location:../index.php?mail=sent");
                        exit();
                    }
                    else{
                        header("Location:../index.php?error=mailnotsent");
                        exit();
                        }
                }else{
                    header("Location:../index.php?error=emaildoesnotexist");
                    exit();
                }
            }
        }
            else {
            header("location:../index.php?error=notsuccessful");
            exit();
    }
    
    