'use strict';


const returnTop = document.querySelector('.return_top');  
	
window.addEventListener('scroll', () => {
    let scrollY = window.scrollY;
    if(scrollY >= 150) {
        //classにactive付与
        returnTop.classList.add('active');
        }
    else {
        //classからactive削除
        returnTop.classList.remove('active');
    }
});

// navbarにのaタグにactiveクラスを追加する
var navLinksActive = document.querySelectorAll(".nav-links a");

for (var i = 0; i < navLinksActive.length; i++) {
    if (navLinksActive[i].href === document.URL) {
        navLinksActive[i].classList.add("active");
    }
}

// ハンバーガーメニュー
const burger = document.querySelector(".burger");
const nav = document.querySelector(".nav-links");
const navLinks = document.querySelectorAll(".nav-links li");

burger.addEventListener("click", () => {
  nav.classList.toggle("nav-active");

  navLinks.forEach((link, index) => {
    if (link.style.animation) {
      link.style.animation = "";
    } else {
      link.style.animation = `navLinksFade 0.5s ease forwards ${
        index / 7 + 0.4
      }s`;
    }
  });
  //burger animataion
  burger.classList.toggle("toggle");
});
