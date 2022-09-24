<?php
    session_start();
    include_once 'dbh.inc.php';
    if(isset($_POST['btn'])){
        $username = $_SESSION['username'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        $dbquery = "select * from client where clientusername='$username';";
        $resultdb=mysqli_query($conn,$dbquery);
        if(mysqli_num_rows($resultdb)>0){
            $row=mysqli_fetch_assoc($resultdb);
            $dbemail = $row['clientemail'];
            $dbphone = $row['clientphone'];
            $dbaddress = $row['clientaddress'];
            $dbcity = $row['clientcity'];
            $dbstate = $row['clientstate'];
        if(!empty($name)){
            if(!$name === $name){
                if(!preg_match("/\W/",$name)){
                    header("location:../myinfo.php?error=invalidname");
                    exit();
                }else{
                    $sqlname ="update client set clientname='$name' where clientusername='$username';";
                    $resultname = mysqli_query($conn,$sqlname);
                }
            }
        }
        if(!empty($email)){
            if($email !== $dbemail){
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                header("Location:../myinfo.php?error=invalidemail");
                exit();
            }else{
                $sqlcheck = "select * from client where clientemail='$email';";
                $resultcheck=mysqli_query($conn,$sqlcheck);
                if(mysqli_num_rows($resultcheck)>0){
                    header("Location:../myinfo.php?error=emailexists");
                    exit();
                }else{
                $sqlemail ="update client set clientemail='$email' where clientusername='$username';";
                $resultemail = mysqli_query($conn,$sqlemail);
                }
            }
        }
    }else{
        header("Location:../myinfo.php?error=emptyemail");
        exit();  
    }
        if(!empty($phone)){
            if($phone !== $dbphone){
            $phonecount = strlen($phone);
            if(!preg_match("/[0-9]/",$phone) || !($phonecount === 10)){
                header("Location:../myinfo.php?error=invalidphone");
                exit();
            }else{
                $phoneno = (string)$phone;
                $sqlphone ="update client set clientphone='$phoneno' where clientusername='$username';";
                $resultphone = mysqli_query($conn,$sqlphone);   
         }
        }
    }else{
        header("Location:../myinfo.php?error=error=emptyphone");
        exit();  
    }
        if(!empty($address)){
                $sqladdress ="update client set clientaddress='$address' where clientusername='$username';";
                $resultaddress = mysqli_query($conn,$sqladdress);
            
        }
        if(!empty($city)){
            if($city !== $dbcity){
            if(!preg_match("/[a-zA-Z]/",$city)){
                header("location:../myinfo.php?error=invalidcity");
                exit();
            }else{
                $sqlcity ="update client set clientcity='$city' where clientusername='$username';";
                $resultcity = mysqli_query($conn,$sqlcity);
            }
        }
    }else{
        header("Location:../myinfo.php?error=emptycity");
        exit();  
    }
        if(!empty($state)){
            if($state !== $dbstate){
            if(!preg_match("/[a-zA-Z]/",$state)){
                header("location:../myinfo.php?error=invalidstate");
                exit();
            }else{
                $sqlstate ="update client set clientstate='$state' where clientusername='$username';";
                $resultstate = mysqli_query($conn,$sqlstate);
                } 
            }
        }else{
                header("Location:../myinfo.php?error=emptystate");
                exit();  
        }
        header("location:../myinfo.php?update=success");
        exit();
    }

}else{
        header("location:../myinfo.php?pagenotaccessible");
        exit();
    }