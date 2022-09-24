<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <form action="" class="myform">
            <label for="name">Enter Name:</label>
            <input type="text" name="name" id="nameadsf" placeholder="Enter the name" required onkeyup="thisFunction(this.id)">
        </form>
        <p id="display">

        </p>

        <script>
            function thisFunction(str){
                document.getElementById("display").innerHTML=str;
                if(str==""){
                    document.getElementById("display").innerHTML='';
                }else{
                    let xhttp=new XMLHttpRequest();
                    xhttp.onreadystatechange = function(){   
                        if(xhhtp.status==200 && xhttp.readyState==4)
                        {
                            document.getElementById("display").innerHTML=this.responseText; 
                        }
                    }
                    xhttp.open("GET","backendRequest.php?str="+str,true);
                    xhttp.send();
                }
            }
        </script>
    </body>
</html>