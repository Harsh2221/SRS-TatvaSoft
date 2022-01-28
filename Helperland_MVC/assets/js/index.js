"use strict";

const tabOne = document.querySelector(".tab-1");
const tabTwo = document.querySelector(".tab-2");
const tabOneContent = document.querySelector(".tab-1-content");
const tabTwoContent = document.querySelector(".tab-2-content");

tabOne.addEventListener("click", () => {
  tabOne.classList.add("active");
  tabTwo.classList.remove("active");
  tabOneContent.classList.add("active");
  tabTwoContent.classList.remove("active");
});

tabTwo.addEventListener("click", () => {
  tabOne.classList.remove("active");
  tabTwo.classList.add("active");
  tabOneContent.classList.remove("active");
  tabTwoContent.classList.add("active");
});
