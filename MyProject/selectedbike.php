<?php   
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="cssfiles/selectedbike.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Courgette&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Courgette&family=Francois+One&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/9edcdd8d08.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="selected-bike-container">
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
            }
                $bikeid= $_GET['bikeid'];
                $sql = "select * from stock where bikeid='$bikeid';";
                $result=mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) > 0){
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='heading-wrapper'>
                                <h2 class='heading'>".strtoupper($row['bikename'])."</h2>
                            </div>
                            <div class='selected-bike-wrapper'>
                                <div class='bikeimages-container'>
                                    <div class='bikeimages-wrapper'>
                                        <div class='main-image-container'>
                                            <img src='productimages/".$row['bikeimage1']."' alt='bike-image' id='bikeimage'>
                                            <div class='all-images-flex-container'>
                                            <div class='image1 image'>
                                                <img src='productimages/".$row['bikeimage1']."' alt='bike-image' id='img1'>
                                            </div>
                                            <div class='image2 image'>
                                                <img src='productimages/".$row['bikeimage2']."' alt='bike-image' id='img2'>
                                            </div>
                                            <div class='image3 image'>
                                                <img src='productimages/".$row['bikeimage3']."' alt='bike-image' id='img3'>
                                            </div>
                                            <div class='image4 image'>
                                                <img src='productimages/".$row['bikeimage4']."' alt='bike-image' id='img4'>
                                            </div>
                                        </div>
                                        </div><hr id='hr2'>
                                        <div class='bottom-half-container'>
                                            <div class='bike-name-price-container'>";
                                                if(isset($_SESSION['username'])){
                                                    $username = $_SESSION['username'];
                                                    $query = "select * from cart where clientusername='$username' AND bikeid='$bikeid';";
                                                    $result1 = mysqli_query($conn,$query);
                                                    if(mysqli_num_rows($result1)>0){
                                                        echo "<a href='advanceinvoice.php?bikeid=".$row['bikeid']."&pagename=selectedbike' alt='' id='book-a'><div class='book-now-btn'>
                                                    <div id='book-btn'><i class='fas fa-book'></i>Book Now</div>
                                                </div></a> 
                                                <a href='includes/remove-from-cart.inc.php?bikeid=".$row['bikeid']."&pagename=selectedbike' alt='' id='remove-a'><div class='remove-from-cart-btn'>
                                                    <div id='remove-cart-btn'><i class='fas fa-shopping-cart'></i>Remove From Cart</div>
                                                </div></a>";
                                                    }else {
                                                echo "<a href='advanceinvoice.php?bikeid=".$row['bikeid']."&pagename=selectedbike' alt='' id='book-a'><div class='book-now-btn'>
                                                    <div id='book-btn'><i class='fas fa-book'></i>Book Now</div>
                                                </div></a>
                                                <a href='includes/add-to-cart.inc.php?bikeid=".$row['bikeid']."&pagename=selectedbike' alt='' id='add-a'><div class='add-to-cart-btn'>
                                                    <div id='add-cart-btn'><i class='fas fa-shopping-cart'></i>Add To Cart</div>
                                                </div></a>";
                                                    }
                                                }else {
                                                   echo "<a href='login.php' alt='' id='book-a'><div class='book-now-btn'>
                                                    <div id='book-btn'><i class='fas fa-book'></i>Book Now</div>
                                                </div></a>
                                                <a href='login.php' alt='' id='add-a'><div class='add-to-cart-btn'>
                                                    <div id='add-cart-btn'><i class='fas fa-shopping-cart'></i>Add To Cart</div>
                                                </div></a>";
                                                }
                                                echo "<div class='name-wrapper'>
                                                    <p id='bike-name'>".strtoupper($row['bikename'])."</p>
                                                </div>
                                                <div class='price-wrapper'>
                                                    <span id='rupee-sign'><i class='fas fa-rupee-sign' aria-hidden='true'></i>".$row['bikeprice']."</span>
                                                    <span id='price'><span id='onwards'> onwards</span></span>
                                                    <p id='ex-showroom-text'>Avg. Ex-Showroom Price</p>
                                                </div>
                                            </div>
                                            <div class='brand-logo-wrapper'>
                                                <a href='selectedbrand.php?name=".$row['bikebrand']."' id='image-a'><img src='productimages/brandslogo/".$row['brandlogo']."' alt='' id='logo'></a>
                                            </div>
                                        </div>
                                    </div>
                                </div><hr id='hr1'>
                                <div class='info-container'>
                                    <div class='bike-mileage-wrapper'>
                                        <p id='bike-mileage'>".$row['bikemileage']."</p>
                                        <p id='bike-mileage-text'>Mileage</p>
                                    </div>
                                <div class='bike-engine-wrapper'>
                                        <p id='bike-engine'>".$row['bikeengine']."cc</p>
                                        <p id='bike-engine-text'>Engine</p>
                                    </div>
                                    <div class='bike-power-wrapper'>
                                        <p id='bike-power'>".$row['bikepower']."</p>
                                        <p id='bike-power-text'>Power</p>
                                    </div>
                                    <div class='bike-kerbweight-wrapper'>
                                        <p id='bike-kerbweight'>".$row['bikekerbweight']."</p>
                                        <p id='bike-kerbweight-text'>Kerb Weight</p>
                                    </div>
                                    <div class='bike-abs-wrapper'>
                                        <p id='bike-abs'>".strtoupper($row['bikeabs'])."</p>
                                        <p id='bike-abs-text'>Abs</p>
                                    </div>
                                </div>
                            </div>"; 
                        }
                    }else {
                        echo "No Results";
                    } ?>   
                </div>
                <?php
                    include_once 'footer.php';
                ?>
                <script src="jsfiles/selectedbike.js"></script>
                <script src="jsfiles/index.js"></script>
    </body>
</html>