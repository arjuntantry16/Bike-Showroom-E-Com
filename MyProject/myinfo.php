<?php

use PhpMyAdmin\Session;

include_once 'includes/dbh.inc.php';
    include_once 'header.php';
    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }else{
        $username=$_SESSION['username'];
    ?>
    <html>
    <head>
        <link rel="stylesheet" href="cssfiles/myinfo.css">
    </head>
    <body>
            <div class="clientinfo-container">
                <?php
                    if(isset($_GET['update'])){
                        $update = $_GET['update'];
                        if($update === "success"){
                            echo "<div class='error-container'><p id='emptyfields'>Updated!</p></div>";
                        }
                    }elseif(isset($_GET['error'])){
                        $errormsg = $_GET['error'];
                        if($errormsg === "invalidemail"){
                            echo "<div class='error-container'><p id='emptyfields'>Invalid Email!</p></div>";
                        }elseif($errormsg === "emailexists"){
                            echo "<div class='error-container'><p id='emptyfields'>Email is Taken!</p></div>";
                        }elseif($errormsg === "invalidname"){
                            echo "<div class='error-container'><p id='emptyfields'>Invalid Name!</p></div>";
                        }elseif($errormsg === "invalidphone"){
                            echo "<div class='error-container'><p id='emptyfields'>Invalid Phone Number!</p></div>";
                        }elseif($errormsg === "invalidcity"){
                            echo "<div class='error-container'><p id='emptyfields'>Invalid City!</p></div>";
                        }elseif($errormsg === "invalidstate"){
                            echo "<div class='error-container'><p id='emptyfields'>Invalid State!</p></div>";
                        }
                    }
                ?>
                <div class="clientinfo-wrapper">
                    <div class="header-wrapper">
                        <h2 id="h1">My Info</h2>
                    </div>
                    <div class="clientlogo-wrapper">
                        <i class="fa fa-user fa-user1" aria-hidden="true"></i>
                    </div>
                    <?php
                    $sql = "select * from client where clientusername='$username';";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        $row=mysqli_fetch_assoc($result);
                        echo "<p id='username'>".$username."</p>
                        <form id='form1' action='includes/clientinfoupdate.inc.php' method='post'>
                        <input type='text' name='name' value='".strtoupper($row['clientname'])."' id='clientname'><i class='fas fa-edit'></i><br>";
                           echo "<label id='email-label'>Email:</label>
                           <input type='text' name='email' value='".$row['clientemail']."' id='email'><br>
                            <label id='phone-label'>Phone Number:</label>
                            <input type='text' name='phone' value='".$row['clientphone']."' id='phone'><br>
                            <label id='address-label'>Address:</label>
                            <input type='text' name='address' value='".strtoupper($row['clientaddress'])."' id='address'><br>
                            <label id='city-label'>City:</label>
                            <input type='text' name='city' value='".strtoupper($row['clientcity'])."' id='city'><br>
                            <label id='state-label'>State:</label>
                            <input type='text' name='state' value='".strtoupper($row['clientstate'])."' id='state'><br>
                            <button type='submit' name='btn' id='btn'>Save</button>
                        </form>";
                        echo "<a href='index.php' id='back-a'><div class='back-btn-wrapper'><p id='back-btn'>Back</p></a></div>";
                    }else{
                        echo "<p id='no-results'>NO Results</p>";
                    }
                }
                ?>
                </div>
            </div>
        <?php
            include_once 'footer.php';
        ?>
        <script src="jsfiles/myinfo.js"></script>
    </body>
</html>