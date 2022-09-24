<?php
    include_once 'includes/dbh.inc.php';
   session_start();
   if(isset($_GET['error'])){
    $error=$_GET['error'];
    if($error==="emptyfields"){
        echo "<div class='cart-info-wrapper considered-info-wrapper'><p id='considered-info'>Enter The Code!<br></p>
        
            <br><div id='ok'>OK</div></div>";
    }
}

if(isset($_GET['error'])){
    $error=$_GET['error'];
    if($error==="wrongcode"){
        echo "<div class='cart-info-wrapper considered-info-wrapper'><p id='considered-info'>Code Does Not Match!<br></p>
        
            <br><div id='ok'>OK</div></div>";
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="cssfiles/codeverification.css">
    </head>
    <body>
        <div class="verification-container">
            <div class="verification-wrapper">
                <div class="verification-header-container">
                    <h1 id="verification-header">Verification</h1>
                </div>
                <div class="form-container">
                    <form id="form1" action="includes/codeverification.inc.php" method="POST">
                        <label>Enter the code sent to your email:</label><br>
                        <input type="text" name="code" placeholder="Enter the code"><br>
                        <button type="submit" name="code-submit" id="code-submit">CONFIRM</button>
                    </form>
                </div>
                <a href="login.php" id="a-tag">Go Back To Login</a>
            </div>
        </div>
       <script src="jsfiles/index.js"></script> 
    </body>
</html>