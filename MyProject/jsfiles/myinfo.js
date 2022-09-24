const editbtn = document.querySelector(".fa-edit");
editbtn.addEventListener("click",enterinfo);

function enterinfo(){
    const namefield = document.getElementById("clientname");
    namefield.style.border="1px solid gray";
}