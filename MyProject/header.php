<html>
    <?php
    require_once 'includes/dbh.inc.php';
        session_start();
    ?>
    <head>
    <script src="https://kit.fontawesome.com/9edcdd8d08.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="cssfiles/headerstyle.css">
    </head>
    <body>
        <div class = "nav-container">
            <nav>
                <ul class = "nav-left">
                    <li><a href="myinfo.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                    <li><a href="index.php">Home</a></li>
                    <li><div class="dropdown">
                        <button class="dropbtn">   Brands</button>
                        <div class="dropdown-content">
                            <?php 
                                $sql = "select * from stock;";
                                $result = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result) > 0 ){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $brandsarray[] = strtoupper($row['bikebrand']);
                                        
                                    }
                                    $sortedarray = array_unique($brandsarray);
                                    for($i = 0; $i < count($sortedarray); $i++){
                                        echo "<a href='selectedbrand.php?name=".strtolower($sortedarray[$i])."'>".$sortedarray[$i]."</a>";
                                    }
                                }else {
                                    echo "<a href='#'>None</a>";                              
                                }
                            ?>
                        </div>
                    </div></li>
                    <li><a href="allbikes.php" id="all-bikes">All Bikes</a></li>
                    <?php
                        if(!isset($_SESSION['username'])){
                        echo "<li><a href='login.php'>Login</a></li>";
                        }
                    ?>
                    <?php if(isset($_SESSION['username'])){
                        if ($_SESSION['username'] === 'admin') {
                            echo "<li><a href='adminupdate.php'>Admin</a></li>";
                        }
                    }?>
                    <li id="more-li"><a href="#" id="more">More  <i class="fas fa-angle-down"></i>
                        <div class="more-dropdown-list">
                        <a href="myinfo.php"><div class="more-items">
                                My Info
                            </div></a>
                            <a href="mybookings.php"><div class="more-items">
                               My Bookings
                            </div></a>
                            <a href="#about-us-header" id="about-us"><div class='more-items'>About Us</div></a>
                            <?php
                                if(!isset($_SESSION['username']) || $_SESSION['username'] == "admin"){
                                    echo "<a href='adminlogin.php'><div class='more-items'>
                                    Admin
                                    </div></a>";
                                }
                            ?>
                        </div>
                </a>
                <div</li>
                </ul>

                <ul class = "nav-right">
                    <form action="search.php" method="post">
                        <input type="text" name="search" placeholder="Search Your Favorite Bikes">
                        <button type="submit" name="search-submit" class="search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                <li><a href="<?php
                if(isset($_SESSION['username'])){
                    echo "cart.php";
                }else {
                        echo "login.php";
                    } ?>">
                    <i class="fas fa-shopping-cart"></i></a></li>
                <?php
                if(isset($_SESSION['username'])){
               echo "<a href='includes/logout.inc.php' class= 'speciala'><li>Logout</li></a>";
                }
                ?>
                </ul>
            </nav>
        </div>
        <script scr = "jsfiles/search.js"></script>

    </body>
</html>