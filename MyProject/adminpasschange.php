<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
    
?>

<html>
    <head>
        <link rel = "stylesheet" href = "cssfiles/adminnav.css">
        <link rel = "stylesheet" href = "cssfiles/adminaddproducts.css">
        <link rel = "stylesheet" href = "cssfiles/adminpasschange.css">
    </head>
    <body>
        <div class="outer-container">
    <div class="overall-container">
        <div class = "left-container">
            <div class = "list-items">
                <a href="admin.php">Add Bikes</a>
            </div>
            <div class = "list-items">
                <a href="updatestock.php">Update Stock</a>
            </div>
            <div class = "list-items">
                <a href="viewbooking.php">View Bookings</a>
            </div>
            <div class = "list-items">
                <a href="viewsales.php">View Sales</a>
            </div>
            <div class = "list-items">
                <a href="customerinfo.php">View Customer Info</a>
            </div>
            <div class = "list-items">
                <a href="adminpasschange.php">Change Password</a>
            </div>
        </div>
        <div class="right-container">
        <?php
                if(isset($_GET['error'])){
                    $errormsg=$_GET['error'];
                    if($errormsg == "emptyfields"){
                        echo "<div class='error-container'><p id='emptyfields'>*Enter All Fields!!</p></div>";
                    }
                    elseif($errormsg == "prevpasswrong"){
                        echo "<div class='error-container'><p id='emptyfields'>*Wrong Password!</p></div>";
                    }elseif ($errormsg == "passdontmatch"){
                        echo "<div class='error-container'><p id='emptyfields'>*Passwords Do Not Match!</p></div>";
                    }
                }elseif(isset($_GET['passchange'])){
                    $success = $_GET['passchange'];
                    echo "<div class='error-container'><p id='emptyfields'>Password Changed!</p></div>";
                }

                ?>
            <div class = "changepassword-form-container">
                <div class="heading-wrapper">
                    <h1 id="heading">Change Password</h1>
                </div>
                <form action="includes/adminpasschange.inc.php" method="post">
                    <div class="inputs-holder">
                        <label for="previouspassword" id="first">Enter Previous Password:</label>
                        <input type="password" name="previouspassword">
                    </div>
                    <div class="inputs-holder">
                        <label for="newpassword" id="second">Enter New Password:</label>
                        <input type="password" name="newpassword">
                    </div>
                    <div class="inputs-holder">
                        <label for="confirmpassword" id="third">Confirm Password:</label>
                        <input type="password" name="confirmpassword">
                    </div>
                    <button type="submit" name="submit" id="passchange-btn">CONFIRM</button>
                </form>
            </div>
        </div>
    </div>
        <div>
</div>
</body>

</html>