const searchbtn = document.querySelector('.fa-search1');
searchbtn.addEventListener("click", formvisible);

function formvisible() {
    const myform = document.querySelector("form");
    if (myform.style.visibility === "hidden") {
        myform.style.visibility = "visible";
    } else {
        myform.style.visibility = "hidden";
    }
}