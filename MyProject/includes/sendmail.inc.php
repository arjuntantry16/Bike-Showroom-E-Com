<?php
    include_once 'dbh.inc.php';
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        
        if(empty($email)){
            header("Location:../forgotpassword.php?error=emptyfields");
            exit();
            } else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                header("Location:../forgotpassword.php?error=invalidemail");
                exit();
            }else{
                $sql = "select * from client where clientemail='$email';";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                
                    $to_email = $email;
                    $subject = "Verification For Password Change";
                    $code = rand(1000,100000);
                   
                    $body = "Your Code for changing the password is $code";
                    $from_header="From: arjuntantry1013@gmail.com";
   
                    if(mail($to_email,$subject,$body,$from_header)){
                        session_start();
                        $_SESSION['code']=$code;
                        $_SESSION['email'] = $email;
                        header("Location:../codeverification.php?mail=sent");
                        exit();
                    }
                    else{
                        header("Location:../forgotpassword.php?error=mailnotsent");
                        exit();
                        }
                }else{
                    header("Location:../forgotpassword.php?error=emaildoesnotexist");
                }
            }
        }
            else {
            header("location:../forgotpassword.php?error=notsuccessful");
            exit();
    }
    
    