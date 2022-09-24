/*LOGIN BUTTON */

// const loginbtn = document.querySelector("button");
// loginbtn.addEventListener("click", login);

// function login() {
//     // const loginsuccessptag = document.querySelector(".after-sign-in");
//     // loginsuccessptag.classList.add("sign-in-success");
//     setTimeout(function() {
//         window.location.href = "../MyProjects/tryout.html";
//         // loginsuccessptag.classList.remove("sign-in-success");
//         // loginsuccessptag.style.visibility = "hidden";
//     }, 2000);

// }

/*LOGIN BUTTON ENDS */

/*PASSWORD VISIBILITY*/

const hidebtn = document.querySelector(".fa-eye");
hidebtn.addEventListener("click", showPassword);

function showPassword() {
    const passwrd = document.querySelector("#passwrd");
    const hidepass = document.querySelector(".fa-eye-slash");
    if (passwrd.type === "password") {
        passwrd.type = "text";
        hidebtn.style.visibility = "hidden";
        hidepass.style.visibility = "visible";
        passwrd.style.marginTop = "20px";

    }
}

const hidepass = document.querySelector(".fa-eye-slash");
hidepass.addEventListener("click", hidePassword);

function hidePassword() {
    if (passwrd.type === "text") {
        passwrd.type = "password";
        hidebtn.style.visibility = "visible";
        hidepass.style.visibility = "hidden";
    }
}

/*PASSWORD VISIBILITY ENDS*/

/*DROP DOWN LIST USER SELECTOR */

const ddlbtn = document.querySelector(".fa-angle-down");
const ddlcontainer = document.querySelector(".ddl-container")
ddlcontainer.addEventListener("click", dropdown);
ddlbtn.addEventListener("click", dropdown);

function dropdown() {
    const userddl = document.querySelector(".user-ddl");
    if (userddl.style.visibility === "visible") {
        userddl.style.visibility = "hidden"
    } else {
        userddl.style.visibility = "visible";
    }
}

/*DROP DOWN LIST USER SELECTOR ENDS*/

/*LOGIN ADMIN OR USER SELECTION*/

const ddlvalue = document.querySelector(".ddl-container");
const admin = document.querySelector(".admin");
const user = document.querySelector(".user");
admin.addEventListener("click", changetoadmin);
user.addEventListener("click", changetouser);

function changetoadmin() {
    ddlvalue.innerHTML = "Admin";
    const userddl = document.querySelector(".user-ddl");
    userddl.style.visibility = "hidden";
    const lihover = document.querySelector(".user-ddl li:hover");
    lihover.style.transition = "none";
}

function changetouser() {
    ddlvalue.innerHTML = "User";
    const userddl = document.querySelector(".user-ddl");
    userddl.style.visibility = "hidden";
    const lihover = document.querySelector(".user-ddl li:hover");
    lihover.style.transition = "none";
}

/*LOGIN ADMIN OR USER SELECTION ENDS*/