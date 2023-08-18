//Slider Show
const controlNext = document.querySelector(".next");
const controlPrev = document.querySelector(".prev");
const slideElement = document.querySelector(".Slider__main--img");
var lengthSlide = document.querySelectorAll(".Slider__main--img img").length;
const directionElement = document.querySelectorAll(".Slider__direction button");
// var widthSlide = slideElement.getBoundingClientRect().width;
var widthSlide = slideElement.offsetWidth;
var index = 0;

setInterval(() => {
  if (slideElement.offsetWidth !== widthSlide) {
    // Thực hiện lệnh khi width thay đổi
    index = 1;
    control();
    console.log("Width đã thay đổi");
    widthSlide = slideElement.offsetWidth;
  }
}, 1);
// function updateWidth() {
//   const { width } = slideElement.getBoundingClientRect();
//   // sử dụng giá trị width ở đây
//   console.log(width);
//   widthSlide = width;

//   // gọi lại hàm updateWidth
//   requestAnimationFrame(updateWidth);
// }
// updateWidth();

function control() {
  directionElement.forEach((element) => {
    element.classList.remove("active");
  });
  directionElement[index].classList.add("active");
  slideElement.style.transform = `translateX(${-(index * widthSlide)}px)`;
}
function next() {
  if (index < lengthSlide - 1) {
    index++;
  } else {
    index = 0;
  }
  control();
}

setInterval(() => {
  next();
}, 8000);
controlNext.onclick = () => {
  next();
};
controlPrev.onclick = () => {
  if (index === 0) {
    index = lengthSlide - 1;
  } else {
    index--;
  }
  control();
};

directionElement.forEach((element) => {
  element.onclick = () => {
    index = element.dataset.direction;
    control();
  };
});
