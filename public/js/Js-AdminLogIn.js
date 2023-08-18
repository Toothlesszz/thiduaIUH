const inputElement = document.querySelectorAll("#form-items input");
const inputElementPassword = document.querySelector("#form-items #pass");
const eyeOpen = document.querySelector(".eye-open");
const eyeClose = document.querySelector(".eye-close");
const submitButton = document.querySelector("#btn-login");
const openPopup = document.querySelector("#btn-ForgotPassword");
const closePopup = document.querySelector("#closePopup");
const popupContainer = document.querySelector(".popupHelp");

//Kiểm tra
for (var i = 0; i < inputElement.length; i++) {
    inputElement[i].oninput = function(e) {
        // console.log(e.target.value);
        if (!e.target.value) {
            e.target.parentElement.querySelector("#form-items span").innerHTML =
                '<i class="fa-solid fa-triangle-exclamation"></i> <span>Vui lòng nhập vào trường này !</span>';

            e.target.classList.add("input-danger");
        } else {
            ArrayinputElement = Array.from(inputElement);

            switch (ArrayinputElement.indexOf(e.target)) {
                case 0:
                    {
                        e.target.parentElement.querySelector("#message").innerHTML =
                        validationEmail(e.target);
                        break;
                    }
                case 1:
                    {
                        e.target.parentElement.querySelector("#message").innerHTML =
                        validationPass(e.target);
                        break;
                    }
            }
        }
    };
    // inputElement[i].onfocus = function (e) {
    //   e.target.parentElement.querySelector("#form-items span").innerHTML = "";
    // };
}

function validationEmail(isEmail) {
    var regEmail =
        /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (!regEmail.test(isEmail.value)) {
        isEmail.classList.add("input-danger");
        validationFormId = false;
        return "Email không hợp lệ!";
    } else {
        isEmail.classList.remove("input-danger");
        validationFormId = true;
        return "";
    }
}

function validationPass(isPass) {
    var regPass =
        /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/;
    if (!regPass.test(isPass.value)) {
        isPass.classList.add("input-danger");
        validationFormPass = false;
        return "Tối thiểu 6 ký tự, ít nhất một chữ cái, một số và một ký tự đặc biệt.";
    } else {
        isPass.classList.remove("input-danger");
        validationFormPass = true;
        return "";
    }
}

eyeOpen.addEventListener("click", function() {
    eyeClose.classList.remove("hidden");
    eyeOpen.classList.add("hidden");
    inputElementPassword.setAttribute("type", "password");
});
eyeClose.addEventListener("click", function() {
    eyeClose.classList.add("hidden");
    eyeOpen.classList.remove("hidden");
    inputElementPassword.setAttribute("type", "text");
});

// //Validation Form
// var validationFormPass = false;
// var validationFormId = false;

// submitButton.addEventListener("click", (event) => {
//     if (validationFormPass == false || validationFormId == false) {
//         event.preventDefault();
//         // alert("Email hoặc Mật khẩu không chính xác!");
//         for (var i = 0; i < inputElement.length; i++) {
//             if (!inputElement[i].value) {
//                 inputElement[i].parentElement.querySelector(
//                         "#form-items span"
//                     ).innerHTML =
//                     '<i class="fa-solid fa-triangle-exclamation"></i> <span>Vui lòng nhập vào trường này !</span>';

//                 inputElement[i].parentElement
//                     .querySelector("#form-items input")
//                     .classList.add("input-danger");
//             }
//         }
//     }
// });
document.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        // Xử lý tại đây khi nhấn phím Enter
        if (validationFormPass == false || validationFormId == false) {
            for (var i = 0; i < inputElement.length; i++) {
                if (!inputElement[i].value) {
                    inputElement[i].parentElement.querySelector(
                            "#form-items span"
                        ).innerHTML =
                        '<i class="fa-solid fa-triangle-exclamation"></i> <span>Vui lòng nhập vào trường này !</span>';

                    inputElement[i].parentElement
                        .querySelector("#form-items input")
                        .classList.add("input-danger");
                }
            }
        } else {
            document.querySelector("#form-login").submit();
        }
    }
});
//Popup
openPopup.addEventListener("click", function() {
    popupContainer.style.display = "block";
});

closePopup.addEventListener("click", function() {
    popupContainer.style.display = "none";
});