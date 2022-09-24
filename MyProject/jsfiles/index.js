const closebtn = document.querySelector("#ok");
closebtn.addEventListener("click", closeftn);

function closeftn() {
    const infowrapper = document.querySelector(".considered-info-wrapper");
    const infowrapper1= document.querySelector(".sold-info-wrapper");
    const infowrapper2 = document.querySelector(".cart-info-wrapper");
     const infowrapper3 = document.querySelector(".cart-info-wrapper1");
      const infowrapper4 = document.querySelector(".considered-info-wrapper1");
    infowrapper.style.transform = "translate(150px,-2000px)";
    infowrapper.style.width="10px";
    infowrapper1.style.transform = "translate(150px,-2000px)";
    infowrapper1.style.width="10px";
    infowrapper2.style.transform = "translate(150px,-2000px)";
    infowrapper2.style.width="10px";
    infowrapper3.style.transform = "translate(150px,-2000px)";
    infowrapper3.style.width="10px";
    infowrapper4.style.transform = "translate(150px,-2000px)";
    infowrapper4.style.width="10px";
}