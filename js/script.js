// ---------------------------CART---------------
let cart = document.querySelector(".cart .icon");
let cartContent = document.querySelector(".cart-content");
cart.addEventListener("click", function () {
    cartContent.classList.toggle("open");
});

let overlay = document.querySelector(".overlay");
overlay.addEventListener("click", function () {
    cartContent.classList.remove("open");
});

var MainItem = document.getElementById("img-main");
var ImgItem = document.querySelectorAll("img");

ImgItem.forEach((img, key) => {
    img.addEventListener("click", function () {
        MainItem.src = ImgItem[key].src;
    });
});
