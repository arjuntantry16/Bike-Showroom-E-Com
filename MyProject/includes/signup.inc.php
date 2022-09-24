<?php 
    include 'dbh.inc.php';

    if(isset($_POST['signup-submit'])){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $pass = $_POST['password'];
        $password = password_hash($pass,PASSWORD_DEFAULT);
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];

        $password1 = $_POST['password'];
        $password2 = $_POST['retype-password']; 

        if(empty($name) || empty($username) || empty($password) ||empty($phone)|| empty($email) || empty($address) || empty($city) || empty($state)){
            header("Location:../signup.php?error=emptyfields&name=$name&uname=$username&phone=$phone&email=$email&address=$address&city=$city&state=$state");
            exit();
        }

        if(!preg_match("/[a-zA-Z0-9]/",$username)){
            header("Location:../signup.php?error=invalidusername&name=$name&phone=$phone&email=$email&address=$address&city=$city&state=$state");
            exit();
        }else {
            $sql = "select * from client where clientusername='$username';";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0){
                header("Location:../signup.php?error=usernametaken&name=$name&uname=&phone=$phone&email=$email&address=$address&city=$city&state=$state");
                exit();  
            }
        } 
        
        $phonecount =strlen($phone);
        
        if(!preg_match("/[a-zA-Z]/",$name)){
            header("Location:../signup.php?error=invalidname&uname=$username&phone=$phone&email=$email&address=$address&city=$city&state=$state");
            exit();
        }elseif(strlen($password1)<6 || strlen($password2)<6){
            header("Location:../signup.php?error=passwordnotstrong&name=$name&uname=$username&phone=$phone&email=$email&address=$address&city=$city&state=$state");
            exit();
        }elseif ($password1 !== $password2) {
            header("Location:../signup.php?error=passwordmissmatch&name=$name&uname=$username&phone=$phone&email=$email&address=$address&city=$city&state=$state");
            exit();
        }elseif(!preg_match("/[0-9]/",$phone) && !($phonecount >= 10 && $phonecount <= 12 )){
            header("Location:../signup.php?error=invalidphone&name=$name&uname=$username&email=$email&address=$address&city=$city&state=$state");
            exit();
        }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            header("Location:../signup.php?error=invalidemail&name=$name&uname=$username&phone=$phone&address=$address&city=$city&state=$state");
            exit();
        }elseif (!preg_match("/[a-zA-Z]/",$city)) {
            header("Location:../signup.php?error=invalidcity&name=$name&uname=$username&phone=$phone&email=$email&address=$address&state=$state");
            exit();
        }elseif (!preg_match("/[a-zA-Z]/",$state)) {
            header("Location:../signup.php?error=invalidstate&name=$name&uname=$username&phone=$phone&email=$email&address=$address&city=$city");
            exit();
        }else{
        $address = $_POST['address'];
        $sql = "insert into client (clientusername,clientname,clientpassword,clientemail,clientphone,clientaddress,clientcity,clientstate) values ('$username','$name','$password','$email','$phone','$address','$city','$state');";
        mysqli_query($conn,$sql);
        session_start();
        $_SESSION['username'] = $username;
        header("Location:../index.php?signup=success");
        }
    }
    else {
        header("Location:../login.php?Signup=NotSuccessfull");
    }