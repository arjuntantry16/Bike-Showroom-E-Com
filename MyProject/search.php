<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
        $text=$_POST['search'];
        if(empty($text)){
             header("location:index.php?error=emptyfields");
         }else{
?>
<html>
    <head>
        <link rel="stylesheet" href="cssfiles/search.css">
    </head>
    <body>
        <div class="search-results-container">
        <?php
        if(isset($_GET['operation'])){
                $cartinfo=$_GET['operation'];
                if($cartinfo === "added"){
                    echo "<div class='cart-info-wrapper sold-info-wrapper considered-info-wrapper'><p id='considered-info'>Added To Cart!<br></p>
                        <div id='ok'>OK</div></div>";
                }elseif($cartinfo === "removed"){
                    echo "<div class='cart-info-wrapper sold-info-wrapper considered-info-wrapper'><p id='considered-info'>Removed From Cart!<br></p>
                       <div id='ok'>OK</div></div>";
                }
            }?>
            <div class="search-results-wrapper">
                <div class="search-results-header-container">
                    <h2 id="search-results-header">
                    Search Results..  
                    </h2>
                </div>
                 <div class="bikes-products-container">
                    <div class="bikes-products-wrapper">
                        <?php
                            $sql = "select * from stock where bikename like '%$text%';";
                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result) > 0){                              
                                while($row = mysqli_fetch_assoc($result)){                                                                  
                                        $image = $row['bikeimage1'];
                                        echo "<div class='products'>
                                        <a href='selectedbrand.php?name=".$row['bikebrand']."&search=$text' id='atag1'><img src='productimages/brandslogo/".$row['brandlogo']."' alt='no-iamge' id='brandlogo'></a>
                                        <a href='selectedbike.php?bikeid=".$row['bikeid']."&search=$text' id='atag1'>
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
                                                            <a href='includes/add-to-cart.inc.php?bikeid=".$row['bikeid']."&pagename=search&name=".$row['bikebrand']."&search=$text' id='add-cart-a'><i class='fas fa-shopping-cart'></i>Add To Cart</a>
                                                        </div>";}else
                                                         {    echo "<div class='remove-from-cart-container'>
                                                          <a href='includes/remove-from-cart.inc.php?bikeid=".$row['bikeid']."&pagename=search&name=".$row['bikebrand']."&search=$text' id='remove-cart-a'><i class='fas fa-shopping-cart'></i>Remove From Cart</a>
                                                        </div>";}
                                                    }else {
                                                        echo "<div class='add-to-cart-container'>
                                                            <a href='index.php?bikeid=".$row['bikeid']."&pagename=search' id='add-cart-a'><i class='fas fa-shopping-cart'></i>Add To Cart</a>
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
                        }
                        
                        ?>
                    </div>
            </div>
        </div>
        <?php
        include_once 'footer.php';
        ?>
        <script src="jsfiles/index.js"></script>
    </body>
</html>
