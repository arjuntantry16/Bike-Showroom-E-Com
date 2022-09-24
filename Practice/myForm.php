<!DOCTYPE html>
<html>
    <script>
                    function mysubmit(name,pass){
                        // if(window.XMLHttpRequest){
                        //     var xhttp=new XMLHttpRequest();
                        // }else{
                        //     var xhttp=new ActiveXObject("Microsoft.XMLHTTP");
                        // }

                        // xhttp.onreadystatechange=function(){
                        //     if(xhttp.readyState==4 && xhttp.status==200){
                        //         document.getElementsByClassName('disp').innerHTML=document.responseText;
                        //     }
                        // }
                        // xhttp.open('GET','myForm.php?name='+name+'password='+pass,true);
                        // xhttp.send();
                        // window.location.href="myForm.php";
                        console.log(name);
                        console.log(pass);
                        }
    </script>
    <body>
        <form action="" method="get" enctype="multipart/form-data">
            <input type="file" name="myfile" id="myfile">
            <input type="text" name="name" id="name" placeholder="Name">
            <input type="text" name="password" id="password">
            <input type="submit" value="Submit" name="submit" onclick="mysubmit(name.value,password.value)">
        </form>
        <?php 
            // if(isset($_GET['action'])) {
            //     $filename='data.json';
            //     $jsondata=file_get_contents($filename);
            //     $decodedjson=json_decode($jsondata,true);
            //     echo "<table>
            //         <tr>
            //             <th>Name</th>
            //             <th>Password</th>
            //         </tr>";
            //         foreach($decodedjson as $data)
            //         {
            //             echo "<tr>
            //             <td>".$data['name']."</td>
            //             <td>".$data['password']."</td>
            //             ";
            //         }
            //     // print_r ($decodedjson);
            // }
                if(isset($_GET['name']) && isset($_GET['password']))
                {
                    $name=$_GET['name'];
                    $pass=$_GET['password'];
                    $conn=mysqli_connect("localhost","root","","practice");
                    if(!$conn){
                        die("Couldnt connect");
                    }
                    else{
                        $sql="insert into myclients values ($name,$pass)";
                        $result=mysqli_query($conn,$sql);
                        if($result){
                            echo "Successfully Inserted client";
                        }
                    }
                $sql="select * from myclients";
                $result=mysqli_query($conn,$sql);
                echo "<table>
                        <tr>
                            <th>Name</th>
                            <th>Password</th>
                        </tr>";
                if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                        echo "<tr>
                        <td>".$row['name']."</td>
                        <td>".$row['password']."</td>
                        </tr>";
                    }
                }
                echo "</table>";
            }
                ?>
            <div class="disp">

            </div>
    </body>
</html>
