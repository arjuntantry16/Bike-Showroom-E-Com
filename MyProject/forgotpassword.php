<?php
    include_once 'includes/dbh.inc.php';
    if(isset($_GET['error'])){
        $error=$_GET['error'];
        if($error==="emptyfields"){
            echo "<div class='cart-info-wrapper considered-info-wrapper'><p id='considered-info'>Enter The Email!<br></p>
            
                <br><div id='ok'>OK</div></div>";
        }
    }
    if(isset($_GET['error'])){
        $error=$_GET['error'];
        if($error==="invalidemail"){
            echo "<div class='cart-info-wrapper considered-info-wrapper'><p id='considered-info'>Enter a Valid Email!<br></p>
            
                <br><div id='ok'>OK</div></div>";
        }
    }
    if(isset($_GET['error'])){
        $error=$_GET['error'];
        if($error==="emaildoesnotexist"){
            echo "<div class='cart-info-wrapper considered-info-wrapper'><p id='considered-info'>User With This Email Does Not Exist!<br></p>
            
                <br><div id='ok'>OK</div></div>";
        }
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/forgotpassword.css">
    </head>
    <body>
        <div class='forgot-password-container'>
            <div class='forgot-password-wrapper'>
                <div class='forgot-password-header-container'>
                    <div class='forgot-password-header-wrapper'>
                        <p id='forgot-password-header'>Forgot Password?</p>
                    </div>
                </div>
                <div class="middle-section-container">
                    <div class="middle-section-wrapper">
                        <p id="enter-email">Enter the Email Address:</p>
                        <form action="includes/sendmail.inc.php" method="post">
                            <input type="text" name="email" id="email-input" placeholder="Enter Email Eg:user@mail.com">
                            <button type="submit" name="submit" id="send-mail">Send Mail</button>
                        </form>
                        <a href="login.php" id="a"><div class="back">Back to Login</div></a>
                    </div>
                </div>
            </div>
        </div>
        <script src="jsfiles/index.js"></script>
    </body>
</html>



