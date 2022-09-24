
<html>
    <head>
        <link rel = "stylesheet" href = "cssfiles/signup.css">
    </head>
    <body>
    
        <div class="signup-form-container">
            
            <div class="signup-form-header">
                <div class="header-container">
                    <h1 class = "signup-header">Sign Up</h1>
                </div>
            </div>

            <div class = "signup-form-body">
                <form action = "includes/signup.inc.php" method = "post">
                    <input type = "text" name = "name" placeholder= "Name Eg:Jason" value="<?php
                    if(isset($_GET['error'])){
                        $signup = $_GET['error'];
                        if($signup !== "invalidname"){
                            $name = $_GET['name'];
                            echo $name;
                        } 
                    }
                    ?>" autofocus><br><br>
                    <input type = "text" name = "username" placeholder= "Username Eg:Jason123" value="<?php
                    if(isset($_GET['error'])){
                        $signup1 = $_GET['error'];
                        if($signup1 !== "invalidusername"){
                            $uname = $_GET['uname'];
                            echo $uname;
                        }
                    }
                    ?>" ><br><br>
                    <input type = "password" name = "password" placeholder= "Password"><br><br>
                    <input type = "password" name = "retype-password" placeholder= "Retype Password"><br><br>
                    <input type = "text" name = "phone" placeholder= "Phone Number"value="<?php
                    if(isset($_GET['error'])){
                        $signup2 = $_GET['error'];
                        if($signup2 !== "invalidphone"){
                            $iphone = $_GET['phone'];
                            echo $iphone;
                        }
                    }
                    ?>"><br><br>
                    <input type = "text" name = "email" placeholder= "E-mail Eg:user@gmail.com" value="<?php
                    if(isset($_GET['error'])){
                        $signup3 = $_GET['error'];
                        if($signup1 !== "invalidemail"){
                            $email3 = $_GET['email'];
                            echo $email3;
                        }
                    }
                    ?>"><br><br>
                    <textarea name="address" rows="5" cols="41" placeholder= "Address" ><?php
                    if(isset($_GET['error'])){
                        $signup4 = $_GET['error'];
                        if($signup4 !== "invalidaddress"){
                            $address1 = $_GET['address'];
                            echo $address1;
                        }
                    }
                    ?></textarea><br><br>
                    <input type = "text" name = "city" placeholder= "City Eg:Udupi" value="<?php
                    if(isset($_GET['error'])){
                        $signup4 = $_GET['error'];
                        if($signup4 !== "invalidcity"){
                            $city1 = $_GET['city'];
                            echo $city1;
                        }
                    }
                    ?>"><br><br>
                    <input type = "text" name = "state" placeholder= "State Ex:Karnataka" value="<?php
                    if(isset($_GET['error'])){
                        $signup5 = $_GET['error'];
                        if($signup5 !== "invalidstate"){
                            $state1 = $_GET['state'];
                            echo $state1;
                        }
                    }
                    ?>"><br><br>
                    <button type = "submit" name = "signup-submit">Sign Up</button><br><br>
                    <a href="login.php">Already a Member?</a>
                </form>
                
            </div>
            <?php
                if(!isset($_GET['error'])){
                 exit();
                 }else {
                    $errmsg = $_GET['error'];
  
                if($errmsg == "emptyfields"){
                echo "<p class='errorhandler'>Fill in all the fields!</p>";
                exit();
                 }elseif ($errmsg == "usernametaken") {
                echo "<p class='errorhandler'>Username is taken!</p>";
                exit();
                 }elseif ($errmsg == "invalidusername") {
                echo "<p class='errorhandler'>Username is not valid!</p>";
                exit();
                exit();
                 }elseif ($errmsg == "invalidname") {
                echo "<p class='errorhandler'>Not a valid name!</p>";
                exit();
                 }elseif ($errmsg == "passwordmissmatch") {
                echo "<p class='errorhandler'>Passwords do not match!</p>";
                exit();
                 }elseif ($errmsg == "passwordnotstrong") {
                    echo "<p class='errorhandler1'>Password Must Contain 7 Characters!</p>";
                    exit();
                     }
                 elseif ($errmsg == "invalidphone") {
                echo "<p class='errorhandler'>Not a valid phone number!</p>";
                exit();
                 }elseif ($errmsg == "invalidemail") {
                echo "<p class='errorhandler'>Not a valid email!</p>";
                exit();
                }elseif ($errmsg == "invalidcity") {
                echo "<p class='errorhandler'>Not a valid city name!</p>";
                exit();
                 }elseif ($errmsg == "invalidstate") {
                echo "<p class='errorhandler'>Not a valid state name!</p>";
                exit();
                }elseif ($_GET['Signup'] == "NotSuccessfull") {
                echo "<p class='errorhandler'>Fill in the details to login!</p>";
                exit();
                 }  
                }
                            ?>  
        </div>
        
    </body>
    
</html>