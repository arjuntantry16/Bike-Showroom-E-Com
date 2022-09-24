function clicked(){
    let dobdate=document.getElementById("dob");
    var datediff=Date.now()-dobdate.getTime();
    console.log(datediff);
}