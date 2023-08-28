//UpLoad Hình ảnh
// Get the input element and submit button
const fileInput = document.querySelectorAll("#FileInput");
// const UploadImg = document.querySelector("#btn-UploadImg");

// Add an event listener to the input element
var checkType = false;
for (var i = 0; i < fileInput.length; i++) {
    fileInput[i].addEventListener("input", function(e) {
        // Get the file object from the input element
        const file = e.target.files[0];
        const fileType = file.type;
        const fileSize = file.size;
        const maxSize = 2000000;
        if (
            (fileType != "image/png" &&
                fileType != "image/jpeg" &&
                fileType != "application/pdf") ||
            fileSize > maxSize
        ) {
            MessageImgError();
            e.target.value = "";
            StyleProof(e.target, "rgba(155, 155, 155, 1)", "File minh chứng");
            checkType = false;
        } else {
            // Create a FileReader object to read the file
            const reader = new FileReader();
            checkType = true;
            // Set up the FileReader object to handle the load event
            // reader.onload = function () {
            //   // Add the image element to the preview div
            //   const preview = document.querySelector("#DefaultImg");
            //   preview.src = URL.createObjectURL(file);
            //   preview.appendChild(img);
            // };
            StyleProof(e.target, "rgba(29, 171, 161, 1)", "Đã upload File!");
            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
    });
}

function StyleProof(isProof, Color, Text) {
    isProof.parentElement.querySelector("i").style.color = Color;
    isProof.parentElement.querySelector("span").style.color = Color;
    isProof.parentElement.style.borderColor = Color;
    isProof.parentElement.querySelector("span").innerHTML = Text;
}
// UploadImg.addEventListener("click", function (event) {
//   if (checkType == false) {
//     event.preventDefault();
//   }
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
          Lỗi UPLOAD minh chứng!
        </p>
        <p class="message__content--note">
          Định dạng File là 'jpeg', 'png' hoặc "PDF" và không quá 2MB.
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

//Popup
const openPopupConfirmSubmit = document.querySelector(".btn-ConfirmSubmit");
const closePopupConfirmSubmit = document.querySelector(
    "#close-popupConfirmSubmit"
);
const popupConfirmSubmit = document.querySelector(".popupConfirmSubmit");
const submitConfirmSubmit = document.querySelector("#submit-ConfirmSubmit");
const checkSubmit = document.querySelector("#RegistrationSubmit");

openPopupConfirmSubmit.addEventListener("click", function(e) {
    //   popupConfirmSubmit.style.display = "block";
    if (checkSubmit.checkValidity()) {
        // Nếu form không hợp lệ, chặn sự kiện submit và hiển thị thông báo lỗi
        e.preventDefault();
        popupConfirmSubmit.style.display = "block";
    }
});

closePopupConfirmSubmit.addEventListener("click", function() {
    popupConfirmSubmit.style.display = "none";
});
submitConfirmSubmit.addEventListener("click", function() {
    checkSubmit.submit();
});

//Comment
var commentDepart = document.querySelector("#commentDepart");
var commentManage = document.querySelector("#commentManage");
var commentDepartValue = commentDepart.value;
var commentManageValue = commentManage.value;

function commentvalue() {
    commentDepart.parentElement.querySelector("textarea").value =
        commentDepartValue +
        commentDepart.parentElement.querySelector("textarea").value;
    commentManage.parentElement.querySelector("textarea").value =
        commentManageValue +
        commentManage.parentElement.querySelector("textarea").value;
    console.log(commentDepartValue);
}

commentvalue();

commentDepart.parentElement
    .querySelector("textarea")
    .addEventListener("keydown", function(e) {
        if (!e.target.value.includes(commentDepartValue)) {
            e.target.value = commentDepartValue;
        }
    });
commentManage.parentElement
    .querySelector("textarea")
    .addEventListener("keydown", function(e) {
        if (!e.target.value.includes(commentManageValue)) {
            e.target.value = commentManageValue;
        }
    });
//popupRegReset
const openpopupRegReset = document.querySelector("#btn-RegReset");
const closepopupRegReset = document.querySelector("#close-popupRegReset");
const popupRegReset = document.querySelector(".popupRegReset");
// const submitConfirmSubmit = document.querySelector("#submit-ConfirmSubmit");
// const checkSubmit = document.querySelector("#RegistrationSubmit");

openpopupRegReset.addEventListener("click", function() {
    //   popupConfirmSubmit.style.display = "block";

    popupRegReset.style.display = "block";
});

closepopupRegReset.addEventListener("click", function() {
    popupRegReset.style.display = "none";
});