<?php
    $jsonfile="data.json";
if(isset($_POST['submit'])){
    try{
        $formdata=array("uname"=>$_POST['uname'],"phno"=>$_POST['phno'],"email"=>$_POST['email']);
        $jdata=file_get_contents($jsonfile);
        $decodejson=json_decode($jdata,true);
        array_push($decodejson,$formdata);
        $name=($decodejson[3]['phno']);
        echo $name;
        echo "<br>";
        $jsondata=json_encode($decodejson,JSON_PRETTY_PRINT);

        if(file_put_contents($jsonfile,$jsondata)){
            echo "File successfully uploaded";
        }
            else{
            echo "File not updated!";
        }
    }catch(Exception $e){
        echo "Error!";
        $e->getMessage();
    }
}else{
    header("Location:myFIle.php");
}
?>

<html>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" value="" name="uname">
            <input type="text" value="" name="phno">
            <input type="text" name="email" id="">
            <button type="submit" name="submit">Submit</button>
        </form>
    </body>
</html>