<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/adminpasswordchange.css">
    </head>
    <body>
        <div class="admin-panel-container">
            <div class="left-panel-container">
                <div class="left-panel-wrapper">
                    <div class="first-item-wrapper item-wrapper">
                        <div class="first-item">
                            Stock
                            <div class="drop-down-contents">
                                <a href="adminupdate.php" id="update-a"><div class="update">Update</div></a>
                                <a href="adminadd.php" id="add-a"><div class="add">Add Bikes</div></a>
                                <a href="admindelete.php" id="delete-a"><div class="delete">Delete</div></a>
                            </div>
                        </div>
                    </div>
                    <div class="second-item-wrapper item-wrapper">
                        <div class="second-item">
                            <a href="adminbookings.php" id="bookings-a">
                            <div class="bookings">Bookings
                            </div></a>
                        </div>
                    </div>
                    <div class="third-item-wrapper item-wrapper">
                        <div class="third-item">
                            <a href="adminsales.php" id="sales-a">
                            <div class="sales">Sales
                            </div></a>
                        </div>
                    </div>
                    <div class="fourth-item-wrapper item-wrapper">
                        <div class="fourth-item">
                            <a href="clientinfo.php" id="client-a">
                            <div class="client-info">Client Info
                            </div></a>
                        </div>
                    </div>
                    <div class="fifth-item-wrapper item-wrapper">
                        <div class="fifth-item">
                        <a href="adminpasswordchange.php" id="change-password-a">
                            <div class="change-password-info">Change Password
                            </div></a>
                        </div>
                    </div>
                    <div class="sixth-item-wrapper item-wrapper">
                        <div class="sixth-item">
                        <a href="taxupdate.php" id="tax-a">
                            <div class="tax-update-info">Tax Update
                            </div></a>
                        </div>
                    </div>
                    <div class="seventh-item-wrapper item-wrapper">
                        <a href='adminaddsupplier.php' id='addsup-a'>
                        <div class="seventh-item">
                            <a href="adminaddsupplier.php" id="tax-a">
                            <div class="supplier-info">Supplier
                            </div></a>
                        </div>
                        <div class="drop-down-contents2">
                                <a href="adminaddsupplier.php" id="add-supplier-a"><div class="update">Add</div></a>
                                <a href="adminorder.php" id="order-a"><div class="add">Order/Update</div></a>
                        </div>
                    </div></a>
                </div>
            </div>
            <!--Right Container-->
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
                <div class="right-wrapper">
                    <div class="adminpass-change-header">
                        <h2 id="adminpass-header">
                                Admin-Change Password
                        </h2>
                        <div class = "changepassword-form-container">
        
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
            </div>
