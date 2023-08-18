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
// const openPopupConfirmSubmit = document.querySelector(".btn-ConfirmSubmit");
// const closePopupConfirmSubmit = document.querySelector(
//   "#close-popupConfirmSubmit"
// );
// const popupConfirmSubmit = document.querySelector(".popupConfirmSubmit");
// const submitConfirmSubmit = document.querySelector("#submit-ConfirmSubmit");
// const checkSubmit = document.querySelector("#RegistrationSubmit");

// openPopupConfirmSubmit.addEventListener("click", function (e) {
//   //   popupConfirmSubmit.style.display = "block";
//   if (checkSubmit.checkValidity()) {
//     // Nếu form không hợp lệ, chặn sự kiện submit và hiển thị thông báo lỗi
//     e.preventDefault();
//     popupConfirmSubmit.style.display = "block";
//   }
// });

// closePopupConfirmSubmit.addEventListener("click", function () {
//   popupConfirmSubmit.style.display = "none";
// });
// submitConfirmSubmit.addEventListener("click", function () {
//   checkSubmit.submit();
// });

//checkboxStandard
const checkboxStandardElement = document.querySelectorAll("#checkboxStandard");

for (var i = 0; i < checkboxStandardElement.length; i++) {
    checkboxStandardElement[i].addEventListener("change", function(e) {
        if (e.target.checked) {
            var CriteriaItemsElement =
                e.target.parentElement.parentElement.parentElement.querySelectorAll(
                    ".Criteria"
                );
            CriteriaItemsElement.forEach(function(e) {
                // Thực hiện các thao tác trên từng phần tử ở đây
                e.style.display = "block";
                console.log(e);
            });
            console.log(e.target.parentElement.parentElement.parentElement);
        } else {
            var CriteriaItemsElement =
                e.target.parentElement.parentElement.parentElement.querySelectorAll(
                    ".Criteria"
                );
            CriteriaItemsElement.forEach(function(e) {
                // Thực hiện các thao tác trên từng phần tử ở đây
                e.style.display = "none";
                console.log(e);
            });
            console.log("Bỏ chọn");
        }
    });
}

//Edit
var editContentIcon = document.querySelectorAll(".editContent__icon");

editContentIcon.forEach(function(icon) {
    icon.addEventListener("click", function() {
        var parent = icon.parentElement;
        var sibling = parent.querySelector("textarea");

        if (sibling.readOnly) {
            sibling.removeAttribute("readonly");
            // sibling.style.border = "0.1vw solid black";
            icon.classList.add("active");
        } else {
            sibling.setAttribute("readonly", "readonly");
            // sibling.style.border = "none";
            icon.classList.remove("active");
        }
    });
});