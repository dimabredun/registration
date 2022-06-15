const signin = document.querySelector(".signin");
const register = document.querySelector(".register");
const form = document.querySelector("#form");
const switchs = document.querySelectorAll(".switch");

let current = 1;


function tab2() {
    form.style.marginLeft = "-100%";
    signin.style.background = "none";
    register.style.background = "linear-gradient(45deg, #00d5fc, #046af6);";
    switchs[current - 1].classList.add("active");
}

function tab1() {
    form.style.marginLeft = "0";
    register.style.background = "none";
    signin.style.background = "linear-gradient(45deg, #00d5fc, #046af6);";
    switchs[current - 1].classList.remove("active");
}
