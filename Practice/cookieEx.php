<?php
    $cookiename="Username";
    $cookievalue="ArjunTantry";
    setCookie($cookiename,$cookievalue,time() + 24,"/");
?>

<html>
    <body>
        <p>
            <?php
                if(isset($_COOKIE[$cookiename])){
                    echo "Cookie Contents: ".$_COOKIE[$cookiename];
                }else{
                    echo "Cookie Not Set!";
                }
            ?>
        </p>
    </body>
</html>