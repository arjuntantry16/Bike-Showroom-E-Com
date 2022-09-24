<?php
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
    $username = $_SESSION['username'];
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/cart.css">
        <script src="https://kit.fontawesome.com/9edcdd8d08.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="cart-container">
            <div class="cart-wrapper">
                <div class="header-wrapper">
                    <h1 id="header1">My Cart</h1>
                </div>
                <?php
                    if(isset($_SESSION['username'])){
                    $sql = "select * from cart where clientusername='$username';";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row=mysqli_fetch_assoc($result)){
                            $bikeid = $row['bikeid'];
                            $query = "select * from stock where bikeid='$bikeid';";
                            $res = mysqli_query($conn,$query);
                            $row2 = mysqli_fetch_assoc($res);
                        echo "<div class='bike-info-container'>
                                    <div class='bike-image-container'><a href='selectedbike.php?bikeid=".$row2['bikeid']."&pagename=cart' id='selected-a'>
                                        <hr id='hr3'><div class='bike-image-wrapper'>
                                            <img src='productimages/".$row2['bikeimage1']."' alt='bike-image' id='image'>
                                        </div></a>
                                    </div>
                                    <div class='bike-info'>
                                        <div class='name-container'>
                                           <p id='bikename'>".strtoupper($row2['bikename'])."</p>
                                        </div>
                                        <div class='price-specs-container'>
                                            <div class='price-container'>
                                                <p id='ex-showroom'>Avg. Ex-Showroom Price</p>
                                                <span id='rupee-sign'><i class='fas fa-rupee-sign' aria-hidden='true'></i></span>
                                                <span id='price'>".$row2['bikeprice']."<span id='onwards'> onwards</span></span>
                                                    <div class='book-now-button-wrapper'><a href='advanceinvoice.php?bikeid=".$row2['bikeid']."&pagename=cart' id='book-a'>
                                                        <span id='book-now-symbol'><i class='fas fa-book'></i></span>   
                                                        <span id='book-now'>Book Now</span>                              
                                                    </div>
                                                </a>
                                            </div><hr id='hr2'>
                                            <div class='specs-container'>
                                                <p id='key-specs'>Key Specs</p>
                                                <div class='specs-wrapper'>
                                                        <span id='bikespecs'>".$row2['bikeengine']."cc</span>
                                                        <span id='bikespecs'>".$row2['bikepower']."</span>
                                                        <span id='bikespecs'>".$row2['bikemileage']."</span>
                                                </div>

                                                <div class='remove-cart-btn-wrapper'><a href='includes/remove-from-cart.inc.php?bikeid=".$row2['bikeid']."&pagename=cart' id='remove-a'>
                                                    <div class='remove-cart-btn'><i class='fas fa-shopping-cart'></i>Remove From Cart</div>
                                               </a></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <hr id='hr3'>
                                </div>";
                        }
                        }else {
                        echo "<p class='no-results'>No Bikes.</p>";
                    }
                    }else {
                        header("Location:login.php");
                    }

                    
                ?>
                
            </div>
        </div>
        <?php
        include_once 'footer.php'; 
        ?>
    </body>
</html>