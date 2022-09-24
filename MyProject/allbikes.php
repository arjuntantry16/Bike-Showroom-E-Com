<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
?>
<html>
    <head>  
        <link rel = "stylesheet" href="cssfiles/allbikes.css">
        <script src="https://kit.fontawesome.com/9edcdd8d08.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="all-bikes-container">
            <div class="all-bikes-wrapper">
                <div class="allbikes-header-container">
                    <h1 id="allbikes-header">All Bikes</h1>
                </div>
                <div class="bikes-products-container">
                    <?php
                if(isset($_GET['operation'])){
                    $cartinfo=$_GET['operation'];
                    if($cartinfo === "added"){
                        echo "<div class='cart-info-wrapper sold-info-wrapper considered-info-wrapper'><p id='considered-info'>Added To Cart!<br></p>
                            <div id='ok'>OK</div></div>";
                    }elseif($cartinfo === "removed"){
                        echo "<div class='cart-info-wrapper sold-info-wrapper considered-info-wrapper'><p id='considered-info'>Removed From Cart<br></p>
                           <div id='ok'>OK</div></div>";
                    }
                }?>
                    <div class="bikes-products-wrapper">
                        <?php
                            $sql = "select * from stock;";
                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result) > 0){                              
                                while($row = mysqli_fetch_assoc($result)){                                                                  
                                        $image = $row['bikeimage1'];
                                        echo "<div class='products'>
                                        <a href='selectedbrand.php?name=".$row['bikebrand']."' id='atag1'><img src='productimages/brandslogo/".$row['brandlogo']."' alt='no-iamge' id='brandlogo'></a>
                                        <a href='selectedbike.php?bikeid=".$row['bikeid']."' id='atag1'>
                                                <div class='image-container'>
                                                    <img src='productimages/".$image."' alt='bikeimage' id='bikeimage'>
                                                </div>

                                                    <div class='info-container'> ";
                                                    if(isset($_SESSION['username'])){
                                                        $username = $_SESSION['username'];
                                                        $bike=$row['bikeid'];       
                                                        $query = "select * from cart where bikeid='$bike' AND clientusername='$username';";
                                                        $result1=mysqli_query($conn,$query);
                                                        if(mysqli_num_rows($result1) < 1){                                          
                                                           echo "<div class='add-to-cart-container'>
                                                            <a href='includes/add-to-cart.inc.php?bikeid=".$row['bikeid']."&pagename=allbikes' id='add-cart-a'><i class='fas fa-shopping-cart'></i>Add To Cart</a>
                                                        </div>";}else
                                                         {    echo "<div class='remove-from-cart-container'>
                                                          <a href='includes/remove-from-cart.inc.php?bikeid=".$row['bikeid']."&pagename=allbikes' id='remove-cart-a'><i class='fas fa-shopping-cart'></i>Remove From Cart</a>
                                                        </div>";}
                                                    }else {
                                                        echo "<div class='add-to-cart-container'>
                                                            <a href='includes/add-to-cart.inc.php?bikeid=".$row['bikeid']."&pagename=allbikes' id='add-cart-a'><i class='fas fa-shopping-cart'></i>Add To Cart</a>
                                                        </div>";
                                                    }
                                                       echo "<div class='bikename-container'>
                                                            <p id='bikename'>".strtoupper($row['bikename'])."</p> 
                                                        </div>
                                                        <div class='specs-container'>
                                                            <span id='bikespecs'>".$row['bikeengine']."cc</span>
                                                            <span id='bikespecs'>".$row['bikepower']."</span>
                                                            <span id='bikespecs'>".$row['bikemileage']."</span>
                                                        </div>
                                                        <div class='ex-showroom-text-wrapper'>
                                                            <p id='ex-showroom-text'>Avg. Ex-Showroom Price</p>
                                                        </div>
                                                        <div class='price-info-container'>
                                                            <div class='price-info-wrapper'>
                                                                <span><i class='fas fa-rupee-sign' aria-hidden='true'></i></span>
                                                                <span id='price'>".$row['bikeprice']."<span id='onwards-text'> onwards</span></span>
                                                            </div>
                                                        </div>
                                                        <a href='selectedbike.php?bikeid=".$row['bikeid']."' id='btn-a'><div class='moredetails-button-wrapper'>
                                                            <div class='moredetails-button1'>
                                                                More Details
                                                            </div>
                                                        </a>
                                                    </div>
                                                    </div>
                                            </a>  </div>
                                        ";
                                }       
                            }else {
                                echo "No Results Found";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include_once 'footerall.php';
        ?>
        <script src="jsfiles/index.js"></script>
    </body>
</html>