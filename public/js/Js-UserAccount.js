// Get the input element and submit button
const fileInput = document.querySelector("#FileInput");
const UploadImg = document.querySelector("#btn-UploadImg");
const preview = document.querySelector("#DefaultImg");

// Add an event listener to the input element
let checkType = false;
fileInput.addEventListener("input", function(e) {
    // Get the file object from the input element
    const file = e.target.files[0];
    const fileType = file.type;

    if (fileType !== "image/png" && fileType !== "image/jpeg") {
        e.target.value = "";
        checkType = false;
        MessageImgError();
    } else {
        checkType = true;
        renderCroppedImage(file);
    }
});

function renderCroppedImage(file) {
    // Create a FileReader object to read the file
    const reader = new FileReader();

    // Set up the FileReader object to handle the load event
    reader.onload = function() {
        // Create an image element
        const img = new Image();
        img.src = URL.createObjectURL(file);

        // Handle the image load event
        img.onload = function() {
            // Create a canvas element
            const canvas = document.createElement("canvas");
            const ctx = canvas.getContext("2d");

            // Define the desired aspect ratio (1:1 in this case)
            const aspectRatio = 1;

            // Calculate the dimensions for the 1:1 aspect ratio
            let width, height;
            if (img.width > img.height) {
                width = img.height * aspectRatio;
                height = img.height;
            } else {
                width = img.width;
                height = img.width * aspectRatio;
            }

            // Set the canvas dimensions to the desired dimensions
            canvas.width = width;
            canvas.height = height;

            // Calculate the cropping position to center the image
            const x = (img.width - width) / 2;
            const y = (img.height - height) / 2;

            // Clear the canvas
            ctx.clearRect(0, 0, width, height);

            // Draw the image onto the canvas with the desired dimensions and cropping
            ctx.drawImage(img, x, y, width, height, 0, 0, width, height);

            // Convert the canvas content to a data URL
            const croppedImageDataUrl = canvas.toDataURL("image/jpeg");

            // Clear any previous content in the preview div
            preview.innerHTML = "";

            // Add the image element to the preview div
            preview.src = croppedImageDataUrl;
            preview.appendChild(img);
        };
    };

    // Read the file as a data URL
    reader.readAsDataURL(file);
}

UploadImg.addEventListener("click", function(event) {
    if (!checkType) {
        event.preventDefault();
        MessageImgError();
    }
});

// Add an event listener to the submit button
// submitButton.addEventListener("click", function (event) {
//   event.preventDefault(); // Prevent the form from submitting
//   // Your upload code here
// });

const inputElement = document.querySelectorAll(".ChangePass__items input");
const inputElementPassword = document.querySelector(".ChangePass__items #pass");
const eyeOpen = document.querySelectorAll(".eye-open");
const eyeClose = document.querySelectorAll(".eye-close");
const submitButton = document.querySelector("#btn-changePass");

//Kiểm tra
for (var i = 0; i < inputElement.length; i++) {
    inputElement[i].onblur = function(e) {
        // console.log(e.target.value);
        if (!e.target.value) {
            e.target.parentElement.querySelector(
                    ".ChangePass__items span"
                ).innerHTML =
                '<i class="fa-solid fa-triangle-exclamation"></i> <span>Vui lòng nhập vào trường này !</span>';

            e.target.classList.add("input-danger");
        } else {
            ArrayinputElement = Array.from(inputElement);

            switch (ArrayinputElement.indexOf(e.target)) {
                case 0:
                    {
                        e.target.parentElement.querySelector("#message").innerHTML =
                        validationPass(e.target);
                        break;
                    }
                case 1:
                    {
                        e.target.parentElement.querySelector("#message").innerHTML =
                        validationNewPass(e.target);
                        break;
                    }
                case 2:
                    {
                        e.target.parentElement.querySelector("#message").innerHTML =
                        validationRepeatPass(e.target);
                        break;
                    }
            }
        }
    };
    inputElement[i].onfocus = function(e) {
        e.target.parentElement.querySelector(".ChangePass__items span").innerHTML =
            "";
    };
}

function validationPass(isPass) {
    var regPass =
        /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    if (!regPass.test(isPass.value)) {
        isPass.classList.add("input-danger");
        validationFormPass = false;
        return "Tối thiểu tám ký tự, ít nhất một chữ cái, một số và một ký tự đặc biệt.";
    } else {
        isPass.classList.remove("input-danger");
        validationFormPass = true;
        return "";
    }
}

function validationNewPass(isNewPass) {
    var RePassElement = document.querySelector("#RePass");
    var regPass =
        /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/;
    if (!regPass.test(isNewPass.value)) {
        isNewPass.classList.add("input-danger");
        validationFormNewPass = false;
        RePassElement.classList.remove("input-danger");
        RePassElement.parentElement.querySelector("#message").innerHTML = "";
        validationFormRePass = true;
        return "Tối thiểu sáu ký tự, ít nhất một chữ cái, một số và một ký tự đặc biệt.";
    }
    //Xử lý RePass
    else if (RePassElement.value && RePassElement.value != isNewPass.value) {
        isNewPass.classList.remove("input-danger");
        validationFormRePass = false;
        RePassElement.classList.add("input-danger");
        RePassElement.parentElement.querySelector("#message").innerHTML =
            "Mật khẩu không trùng khớp.";
        return "";
    } else {
        isNewPass.classList.remove("input-danger");
        validationFormNewPass = true;
        //Xử lý RePass
        RePassElement.classList.remove("input-danger");
        RePassElement.parentElement.querySelector("#message").innerHTML = "";
        validationFormRePass = true;
        return "";
    }
}

function validationRepeatPass(isRePass) {
    var PassWord = document.querySelector("#NewPass").value;
    if (!PassWord) {
        isRePass.classList.add("input-danger");
        validationFormRePass = false;
        return "Vui lòng nhập mật khẩu";
    } else if (isRePass.value == PassWord) {
        isRePass.classList.remove("input-danger");
        validationFormRePass = true;
        return "";
    } else {
        isRePass.classList.add("input-danger");
        validationFormRePass = false;
        validationFormNewPass = true;
        return "Mật khẩu không trùng khớp.";
    }
}

//Ẩn hiện mật khẩu
for (var a = 0; a < eyeOpen.length; a++) {
    eyeOpen[a].addEventListener("click", function(e) {
        e.target.classList.add("hidden");
        console.log(e.target.parentElement.parentElement);
        e.target.parentElement.parentElement
            .querySelector(".ChangePass__items .eye-close")
            .classList.remove("hidden");
        e.target.parentElement.parentElement
            .querySelector(".ChangePass__items input")
            .setAttribute("type", "password");
    });
}
for (var a = 0; a < eyeClose.length; a++) {
    eyeClose[a].addEventListener("click", function(e) {
        e.target.classList.add("hidden");
        e.target.parentElement.parentElement
            .querySelector(".ChangePass__items .eye-open")
            .classList.remove("hidden");
        e.target.parentElement.parentElement
            .querySelector(".ChangePass__items input")
            .setAttribute("type", "text");
    });
}

//Validation Form
var validationFormPass = false;
var validationFormNewPass = false;
var validationFormRePass = false;

submitButton.addEventListener("click", (event) => {
    if (
        validationFormPass == false ||
        validationFormNewPass == false ||
        validationFormRePass == false
    ) {
        event.preventDefault();
        // alert("Mã ứng viên hoặc Mật khẩu không chính xác!");
        for (var i = 0; i < inputElement.length; i++) {
            if (!inputElement[i].value) {
                inputElement[i].parentElement.querySelector(
                        ".ChangePass__items span"
                    ).innerHTML =
                    '<i class="fa-solid fa-triangle-exclamation"></i> <span>Vui lòng nhập vào trường này !</span>';

                inputElement[i].parentElement
                    .querySelector(".ChangePass__items input")
                    .classList.add("input-danger");
            }
        }
    }
});
//Message
const mainElement = document.querySelector(".MainMessage");

function MessageImgError() {
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
          Lỗi UPLOAD hình ảnh!
        </p>
        <p class="message__content--note">
          Định dạng File được chọn phải là 'jpeg' hoặc 'png' với tỉ lệ 1:1.
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