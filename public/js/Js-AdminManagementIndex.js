//Message
const mainElement = document.querySelector(".MainMessage");

function MessageImgError(Title, Mess) {
    const messageElement = document.createElement("div");
    messageElement.classList.add("message");
    messageElement.style.animation =
        " slideInLeft ease 0.4s,  fadeOut linear 1s 4s forwards";
    messageElement.innerHTML = `
      <div class="message__icon">
        <i class="fa-solid fa-circle-exclamation fa-shake"></i>
      </div>
      <div class="message__content">
        <p class="message__content--title">
         ${Title}
        </p>
        <p class="message__content--note">
          ${Mess}
        </p>
      </div>
      <div class="message__close">
        <i class="fas fa-times"></i>
      </div>`;

    mainElement.append(messageElement);
    const closeElement = document.querySelectorAll(".message__close");

    const autoRemove = setTimeout(() => {
        // mainElement.removeChild(mainElement.childNodes[0]);
        mainElement.childNodes[0].remove();
    }, 4000 + 1000);

    messageElement.onclick = function(e) {
        if (e.target.closest(".message__close")) {
            mainElement.removeChild(messageElement);
            // mainElement.childNodes[0].remove();
            clearTimeout(autoRemove);
        }
    };
}
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

const imageCheckboxes = document.querySelectorAll(".image-checkbox");
const selectedImagesDiv = document.getElementById("selected-images");
const submitEditSlider = document.querySelector("#submitEditSlider");
// const formEditSlider = document.querySelector("#formEditSlider");
// Maximum number of checkboxes allowed to be checked
const maxChecked = 4;

// Array to store selected images
const selectedImages = [];

imageCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function() {
        const index = this.parentElement.parentElement
            .querySelector("img")
            .getAttribute("src");

        if (this.checked) {
            if (selectedImages.length < maxChecked) {
                selectedImages.push(index);
            } else {
                this.checked = false; // Prevent checking more than the limit
                return;
            }
        } else {
            const selectedIndex = selectedImages.indexOf(index);
            if (selectedIndex !== -1) {
                selectedImages.splice(selectedIndex, 1);
            }
        }

        updateSelectedImages();
    });
});

// Update and display the list of selected images
function updateSelectedImages() {
    // Clear the selectedImagesDiv before adding new images
    selectedImagesDiv.innerHTML = "";

    selectedImages.forEach((src, index) => {
        const img = document.createElement("img");
        const input = document.createElement("input");
        img.src = src;
        img.alt = "Image";
        // img.name = `slide[${index}]`; // Sử dụng index trực tiếp
        // img.setAttribute("data-index", index); // Sử dụng index trực tiếp
        selectedImagesDiv.appendChild(img);
        input.type = "hidden";
        input.value = src.split("/").pop();
        input.name = `slide[${index}]`;
        input.setAttribute("data-index", index);
        selectedImagesDiv.appendChild(input);
    });
}
submitEditSlider.addEventListener("click", function(event) {
    // Kiểm tra nếu mảng selectedImages trống

    if (selectedImages.length === 0) {
        // Ngăn sự kiện submit mặc định
        event.preventDefault();
        MessageImgError("KHÔNG THÀNH CÔNG!", "Vui lòng chọn ít nhất một ảnh!");
    }
});

//UpLoad Hình ảnh chứng nhận
// Get the input element and submit button
const fileInputTemplateMedal = document.querySelector("#TemplateMedal");
// const UploadImg = document.querySelector("#btn-UploadImg");

// Add an event listener to the input element
var checkType1 = false;
fileInputTemplateMedal.addEventListener("input", function(e) {
    // Get the file object from the input element
    const filefileInputTemplateMedal = e.target.files[0];
    const fileTypefileInputTemplateMedal = filefileInputTemplateMedal.type;

    if (
        fileTypefileInputTemplateMedal != "image/png" &&
        fileTypefileInputTemplateMedal != "image/jpeg"
    ) {
        MessageImgError(
            "UPLOAD FILE KHÔNG THÀNH CÔNG!",
            "Vui lòng chọn file mẫu chứng nhận có định dạng là jpeg/png"
        );
        e.target.value = "";
        StyleProof1(
            "transparent",
            "<i class='fa-solid fa-file-arrow-up'></i> CHỨNG NHẬN",
            "rgba(155, 155, 155, 1)"
        );
        checkType1 = false;
    } else {
        // Create a FileReader object to read the file
        checkType1 = true;

        StyleProof1(
            "rgba(29, 171, 161, 1)",
            "<i class='fa-solid fa-file-image'></i> ĐÃ CHỌN FILE!",
            "rgb(255, 255, 255)"
        );
        // Read the file as a data URL
    }
});

function StyleProof1(Color, Text, TextColor) {
    document.querySelector(".UploadImage").style.backgroundColor = Color;
    document.querySelector(".UploadImage span").innerHTML = Text;
    document.querySelector(".UploadImage span").style.color = TextColor;
}