<?php
    if(isset($_POST['submit'])){
    $name=$_POST['name'];
    setcookie('username',$name,time() + 60*30);
    setcookie('user','arjun',time() + 60*30);
    header("Location:checkcookies.php");
    }
?>

<html>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" name="name">
        <button type="submit" name="submit">Submit</button>
    </form>
    </body>
</html>