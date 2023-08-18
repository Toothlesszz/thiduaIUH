//UpLoad Hình ảnh
// Get the input element and submit button
const fileInput = document.querySelector("#FileInput");
const UploadImg = document.querySelector("#btn-UploadImg");

// Add an event listener to the input element
var checkType = false;
fileInput.addEventListener("input", function(e) {
    // Get the file object from the input element
    const file = e.target.files[0];
    const fileType = file.type;
    if (fileType != "image/png" && fileType != "image/jpeg") {
        e.target.value = "";
        checkType = false;
        MessageImgError();
    } else {
        // Create a FileReader object to read the file
        const reader = new FileReader();
        checkType = true;
        // Set up the FileReader object to handle the load event
        reader.onload = function() {
            // Add the image element to the preview div
            const preview = document.querySelector("#DefaultImg");
            preview.src = URL.createObjectURL(file);
            // preview.appendChild(img);
        };

        // Read the file as a data URL
        reader.readAsDataURL(file);
    }
});
UploadImg.addEventListener("click", function(event) {
    if (checkType == false) {
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

// submitButton.addEventListener("click", (event) => {
//     if (
//         validationFormPass == false ||
//         validationFormNewPass == false ||
//         validationFormRePass == false
//     ) {
//         event.preventDefault();
//         // alert("Mã ứng viên hoặc Mật khẩu không chính xác!");
//         for (var i = 0; i < inputElement.length; i++) {
//             if (!inputElement[i].value) {
//                 inputElement[i].parentElement.querySelector(
//                         ".ChangePass__items span"
//                     ).innerHTML =
//                     '<i class="fa-solid fa-triangle-exclamation"></i> <span>Vui lòng nhập vào trường này !</span>';

//                 inputElement[i].parentElement
//                     .querySelector(".ChangePass__items input")
//                     .classList.add("input-danger");
//             }
//         }
//     }
// });
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
          Định dạng File được chọn phải là 'jpeg' hoặc 'png'.
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

//Select Custom
var selects = document.querySelectorAll("select");
var selectsIcon = document.querySelector("#selectIcon");

selects.forEach(function(select) {
    var numberOfOptions = select.children.length;
    select.classList.add("select-hidden");

    var wrapper = document.createElement("div");
    wrapper.classList.add("select");
    select.parentNode.insertBefore(wrapper, select);
    wrapper.appendChild(select);

    var selectStyled = document.createElement("div");
    selectStyled.classList.add("select-styled");
    // selectStyled.classList.add("active");
    selectStyled.textContent = select.children[0].textContent;
    wrapper.appendChild(selectStyled);

    var list = document.createElement("ul");
    list.classList.add("select-options");
    //Bổ sung
    list.style.display = "none";
    wrapper.appendChild(list);

    for (var i = 0; i < numberOfOptions; i++) {
        var listItem = document.createElement("li");
        listItem.textContent = select.children[i].textContent;
        listItem.setAttribute("rel", select.children[i].value);
        list.appendChild(listItem);
    }

    var listItems = list.children;

    selectStyled.addEventListener("click", function(e) {
        e.stopPropagation();
        var activeSelects = document.querySelectorAll(".select-styled .active");
        for (var i = 0; i < activeSelects.length; i++) {
            var activeSelect = activeSelects[i];
            if (activeSelect !== selectStyled) {
                activeSelect.classList.remove("active");
                activeSelect.nextElementSibling.style.display = "none";
            }
        }
        selectStyled.classList.toggle("active");
        selectsIcon.classList.toggle("fa-rotate-90");
        selectsIcon.classList.toggle("fa-rotate-270");
        list.style.display = list.style.display === "none" ? "block" : "none";
    });

    for (var i = 0; i < listItems.length; i++) {
        var listItem = listItems[i];
        listItem.addEventListener("click", function(e) {
            e.stopPropagation();
            selectStyled.textContent = this.textContent;
            selectStyled.classList.remove("active");
            select.value = this.getAttribute("rel");
            selectsIcon.classList.add("fa-rotate-90");
            selectsIcon.classList.remove("fa-rotate-270");
            list.style.display = "none";
        });
    }

    document.addEventListener("click", function() {
        selectStyled.classList.remove("active");
        selectsIcon.classList.add("fa-rotate-90");
        selectsIcon.classList.remove("fa-rotate-270");
        list.style.display = "none";
    });
});