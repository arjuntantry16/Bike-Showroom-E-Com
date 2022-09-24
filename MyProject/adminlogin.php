
<!DOCTYPE html>
<html>
<head>   
    <title>My Example page</title>
    <script src="https://kit.fontawesome.com/9edcdd8d08.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="cssfiles/login.css">
</head>

<body> 
    <div class="center">
        <div class="header">
            <div class="login">Login</div>
        </div>
        <!-- <p class="after-sign-in">Login Successfull</p> -->
        <form action= "includes/adminlogin.inc.php" method = "post">
            <a href="#">
                <!-- <p class="ddl-container">Admin
                    <ul class="user-ddl">
                        <li class="user"><a href="login.php">User</a></li>
                        <li class="admin"><a href="adminlogin.php">Admin</a></li>
                    </ul>
                </p> -->
            </a>
            <!-- <a href="#"><i class="fas fa-angle-down"></i></a> -->
            <input type="text" name="username" id="text" placeholder="Username" value="<?php 
             
             if(isset($_GET['Login'])){
                 $login = $_GET['Login'];
                 $username = $_GET['uname'];
                 if($login === "emptyfields"){
                     echo $username;
                 }elseif ($login === "WrongPassword") {
                     echo $username;
                 }elseif ($login === "Usernotfound") {
                     echo $username;
                 }
             }
             
             ?>">
            <i class="fas fa-user"></i>
            <input id="passwrd" type="password" name="password" placeholder="Password">
            <i class="fas fa-eye"></i>
            <i class="fas fa-eye-slash"></i>
            <button id="butn" type="submit" name="login-submit">Sign In</button>
            <!-- <a href="../MyProjects/tryout.html" id="sign-in-atag"></a> -->
            <a href="#" id="forgot-password">Forgot Password?</a>
            <a href="signup.php" id="not-member">Not a Member?</a>
        </form>
        

    </div>
    <script src="jsfiles/login.js">
    </script>
    <?php
        if(!isset($_GET['Login'])){
            exit();
            }else {
            $errmsg = $_GET['Login'];
            if($errmsg == "emptyfields"){
                echo "<p class='loginerrorhandler'>Fill in all the fields!</p>";
                exit();
            }
            elseif ($errmsg == "WrongPassword") {
                echo "<p class='loginerrorhandler'>Wrong Password!</p>";
                exit();
            }
            elseif ($errmsg == "Usernotfound") {
                echo "<p class='loginerrorhandler'>User Does Not Exist!</p>";
                exit();
            }else {
                exit();
            }
            }
        ?>
</body>

</html>