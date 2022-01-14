const toggleAsideOpen = document.querySelector("span#toggle-aside.open");
const toggleAsideClose = document.querySelector("span#toggle-aside.close");
const asideContent = document.querySelector("aside .aside-content");
toggleAsideOpen.addEventListener("click", function () {
  toggleAsideOpen.classList.toggle("active");
  toggleAsideClose.classList.toggle("active");
  asideContent.classList.toggle("active");
});
toggleAsideClose.addEventListener("click", function () {
  toggleAsideOpen.classList.toggle("active");
  toggleAsideClose.classList.toggle("active");
  asideContent.classList.toggle("active");
});
