<?php
    include_once 'includes/dbh.inc.php';
   session_start();
   if(isset($_GET['error'])){
    $error=$_GET['error'];
    if($error==="emptyfields"){
        echo "<div class='cart-info-wrapper considered-info-wrapper'><p id='considered-info'>Enter The Password!<br></p>
        
            <br><div id='ok'>OK</div></div>";
    }
}
if(isset($_GET['error'])){
    $error=$_GET['error'];
    if($error==="passwordsdonotmatch"){
        echo "<div class='cart-info-wrapper considered-info-wrapper'><p id='considered-info'>Passwords Do Not Match!<br></p>
        
            <br><div id='ok'>OK</div></div>";
    }elseif($error="passwordisweak"){
        echo "<div class='cart-info-wrapper considered-info-wrapper'><p id='considered-info'>Passwords Must Contains & Characters!<br></p>
        
        <br><div id='ok'>OK</div></div>";
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="cssfiles/changepassword.css">
    </head>
    <body>
        <div class="change-password-container">
            <div class="change-password-wrapper">
                <div class="change-password-header-container">
                    <h1 id="change-password-header">Change Password</h1>
                </div>
                <div class="form-container">
                    <form id="form1" action="includes/changepassword.inc.php" method="POST">
                        <label>Enter New Password:</label><br>
                        <input type="password" name="newpassword" placeholder="New Password"><br>
                        <label>Re-Enter New Password:</label><br>
                        <input type="password" name="retypenewpassword" placeholder="Retype Password"><br>
                        <button type="submit" name="password-submit" id="password-submit">CONFIRM</button>
                    </form>
                </div>
                <a href="login.php" id="a-tag">Go Back To Login</a>
    
            </div>
        </div>
        <script src="jsfiles/index.js"></script>
    </body>
</html>