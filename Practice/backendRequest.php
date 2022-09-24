<?php
    if(isset($_REQUEST['str'])){
         $q=$_REQUEST['str'];
         if(empty($q)){
            header("location:index.php?operation=failed");
         }else{
            $names="";
            $conn=mysqli_connect("localhost","root","","student");
            if(!$conn){
                die("Connection Lost!");
                header("location:index.php?connection=failed");
            }
            $query="selection * from studenttable where name like '$q%'";
            $result=mysqli_query($conn,$query);
            if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_array($result)){
                   if($name==""){
                    $names=$row['name'];
                   }else{
                    $name.=" , ".$row['name'];
                   }
                }
            }
         }
         echo "Suggestions: ".$name;
    }
?>