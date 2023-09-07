// var checkboxes = document.querySelectorAll(".checkboxQualified input");
// var RegAcceptButton = document.getElementById("btn-RegAccept");

// for (var i = 0; i < checkboxes.length; i++) {
//   checkboxes[i].addEventListener("change", function () {
//     var allChecked = true;
//     for (var j = 0; j < checkboxes.length; j++) {
//       if (!checkboxes[j].checked) {
//         allChecked = false;
//         break;
//       }
//     }
//     RegAcceptButton.disabled = !allChecked;
//   });
// }
function MessageError(Title, Message) {
    const messageElement = document.createElement("div");
    messageElement.classList.add("messageError");
    messageElement.style.animation =
        " slideInLeft ease 0.4s,  fadeOut linear 1s 4s forwards";
    messageElement.innerHTML = `
        <div class="messageError__icon">
          <i class="fa-solid fa-circle-exclamation fa-shake"></i>
        </div>
        <div class="messageError__content">
          <p class="messageError__content--title">
            ${Title}
          </p>
          <p class="messageError__content--note">
          ${Message}
          </p>
        </div>
        <div class="messageError__close">
          <i class="fas fa-times"></i>
        </div>`;

    document.querySelector(".MainMessage").append(messageElement);
    const closeElement = document.querySelectorAll(".messageError__close");

    const autoRemove = setTimeout(() => {
        // document.querySelector(".MainMessage").removeChild(document.querySelector(".MainMessage").childNodes[0]);
        document.querySelector(".MainMessage").childNodes[0].remove();
    }, 4000 + 1000);

    messageElement.onclick = function(e) {
        if (e.target.closest(".messageError__close")) {
            document.querySelector(".MainMessage").removeChild(messageElement);
            // document.querySelector(".MainMessage").childNodes[0].remove();
            clearTimeout(autoRemove);
        }
    };
}
//Popup
const openPopupConfirmSubmit = document.querySelectorAll(".btn-ConfirmSubmit");
const closePopupConfirmSubmit = document.querySelector(
    "#close-popupConfirmSubmit"
);
const popupConfirmSubmit = document.querySelector(".popupConfirmSubmit");
const submitConfirmSubmit = document.querySelector("#submit-ConfirmSubmit");
const checkSubmit = document.querySelector("#RegistrationSubmit");

var btnRegAccept = document.querySelector("#btn-RegAccept");
var checkboxElements = document.querySelectorAll("#checkboxStandard");

// btnRegAccept.addEventListener("click", function (event) {
//   event.preventDefault();
//   var isAnyUnchecked = false;

//   for (var i = 0; i < checkboxElements.length; i++) {
//     if (!checkboxElements[i].checked) {
//       isAnyUnchecked = true;
//       break;
//     }
//   }

//   if (isAnyUnchecked) {
//     // Chặn việc submit form
//     alert("Vui lòng chọn tất cả các checkbox."); // Hiển thị thông báo
//   } else {
//     // Tiếp tục submit form
//     popupConfirmSubmit.style.display = "block";
//   }
// });

var btnOperation = document.querySelector("#btnOperation");
var btnEvaluate = document.querySelector("#btn-Evaluate");

// const labels = document.querySelectorAll(".checkboxQualified__status");
// const classifYoblige = document.querySelectorAll("#Classif");
// const regCriteriaNumber = parseInt(
//   document.querySelector("#regCriteriaNumber").textContent
// );
var StandardItems = document.querySelectorAll(".Standard__Items");
// console.log(classifYoblige);
// let allContainDaDat = true;
let buttonClicked = 0;

btnEvaluate.addEventListener("click", function(e) {
    e.preventDefault();
    // let Status = 0;
    // let criteriaCount = 0;
    // let shouldBreak = false; // Cờ để kiểm tra xem có nên dừng vòng lặp không
    const resultStandard = [];

    StandardItems.forEach((StandardItems) => {
        const classifYoblige = StandardItems.querySelectorAll("#Classif");
        const regCriteriaNumber = parseInt(
            StandardItems.querySelector("#regCriteriaNumber").textContent
        );
        const selectedValue = [];
        const selectedValueRequired = [];

        classifYoblige.forEach((classif) => {
            // if (shouldBreak) {
            //   return; // Nếu cờ shouldBreak là true, thoát vòng lặp
            // }

            const classifText = classif.textContent;
            const radioButtons =
                classif.parentElement.parentElement.querySelectorAll(
                    "input[type=radio]"
                );
            // const labelText = classif.parentElement.parentElement.querySelector(
            //   ".checkboxQualified__status"
            // ).textContent;
            // console.log(checkbox);

            if (classifText !== "Khác") {
                radioButtons.forEach((radio) => {
                    if (radio.checked) {
                        const value = radio.parentElement.textContent.trim();
                        selectedValueRequired.push(value);
                    }
                });
            } else {
                radioButtons.forEach((radio) => {
                    if (radio.checked) {
                        const value = radio.parentElement.textContent.trim();
                        selectedValue.push(value);
                    }
                });
            }
        });
        const allDaDatRequired = selectedValueRequired.every(
            (value) => value === "ĐẠT"
        );
        const atLeastTwoDaDat =
            selectedValue.filter((value) => value === "ĐẠT").length >=
            regCriteriaNumber;
        const hasPhanVanRequired = !selectedValueRequired.includes("CHƯA ĐẠT");
        const atLeastTwoDaDatPhanVan =
            selectedValue.filter((value) => value === "ĐẠT" || value === "PHÂN VÂN")
            .length >= regCriteriaNumber;

        if (allDaDatRequired && atLeastTwoDaDat) {
            resultStandard.push("ĐẠT");
            // buttonClicked = 1;
        } else if (hasPhanVanRequired && atLeastTwoDaDatPhanVan) {
            resultStandard.push("PHÂN VÂN");
            // buttonClicked = 2;
        } else {
            resultStandard.push("CHƯA ĐẠT");
            // buttonClicked = 3;
        }

        // console.log("Selected values:", selectedValueRequired);
        // console.log("Selected values:", selectedValue);
    });
    console.log(resultStandard);
    if (resultStandard.every((value) => value === "ĐẠT")) {
        buttonClicked = 1;
    } else if (
        resultStandard.includes("PHÂN VÂN") &&
        !resultStandard.includes("CHƯA ĐẠT")
    ) {
        buttonClicked = 2;
    } else {
        buttonClicked = 3;
    }
    popupConfirmSubmit.style.display = "block";
});

closePopupConfirmSubmit.addEventListener("click", function() {
    popupConfirmSubmit.style.display = "none";
});
// openPopupConfirmSubmit.forEach(function (btn) {
//   btn.addEventListener("click", function (e) {
//     e.preventDefault();
//     if (btn.id === "btn-RegReject") {
//       //Từ chối
//       var isAnyChecked = false;
//       for (var i = 0; i < checkboxElements.length; i++) {
//         if (!checkboxElements[i].checked) {
//           isAnyChecked = true;
//           break;
//         }
//       }

//       if (!isAnyChecked) {
//         // Chặn việc submit form
//         MessageError(
//           "KHÔNG THỂ DUYỆT",
//           "Không thể nhấn 'Từ chối' khi tất cả tiêu chí đều 'Đạt'."
//         );
//       } else {
//         buttonClicked = 3;
//         // Tiếp tục submit form
//         popupConfirmSubmit.style.display = "block";
//       }
//     }
//     if (btn.id === "btn-RegPropose") {
//       //Xem xét
//       buttonClicked = 2;
//       popupConfirmSubmit.style.display = "block";
//     }
//     if (btn.id === "btn-RegAccept") {
//       var isAnyUnchecked = false;
//       for (var i = 0; i < checkboxElements.length; i++) {
//         if (!checkboxElements[i].checked) {
//           isAnyUnchecked = true;
//           break;
//         }
//       }

//       if (isAnyUnchecked) {
//         // Chặn việc submit form
//         MessageError(
//           "KHÔNG THỂ DUYỆT",
//           "Chỉ được nhấn 'Duyệt' khi tất cả tiêu chí đều 'Đạt'."
//         );
//       } else {
//         buttonClicked = 1;
//         // Tiếp tục submit form
//         popupConfirmSubmit.style.display = "block";
//       }
//     }
//   });
// });

closePopupConfirmSubmit.addEventListener("click", function() {
    popupConfirmSubmit.style.display = "none";
});
submitConfirmSubmit.addEventListener("click", function() {
    if (buttonClicked === 1) {
        btnOperation.value = 1;
    }
    if (buttonClicked === 2) {
        btnOperation.value = 2;
    }
    if (buttonClicked === 3) {
        btnOperation.value = 3;
    }
    checkSubmit.submit();
    console.log(buttonClicked);
});

//
function toggleCheckboxValue(checkbox) {
    checkbox.value = checkbox.checked ? "1" : "0";
}

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