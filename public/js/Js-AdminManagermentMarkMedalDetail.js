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
//Popup
//Popup

const openPopupConfirmSubmit = document.querySelectorAll(".btn-ConfirmSubmit");
const closePopupConfirmSubmit = document.querySelector(
    "#close-popupConfirmSubmit"
);
const popupConfirmSubmit = document.querySelector(".popupConfirmSubmit");
const submitConfirmSubmit = document.querySelector("#submit-ConfirmSubmit");
const checkSubmit = document.querySelector("#RegistrationSubmit");
console.log(openPopupConfirmSubmit);

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
var buttonClicked = 0;

// const labels = document.querySelectorAll(".checkboxQualified__status");
const classifYoblige = document.querySelectorAll("#Classif");
const regCriteriaNumber = parseInt(
    document.querySelector("#regCriteriaNumber").textContent
);
console.log(regCriteriaNumber);
// let allContainDaDat = true;

btnEvaluate.addEventListener("click", function(e) {
    e.preventDefault();

    let allContainDaDat = false;
    let criteriaCount = 0;

    // labels.forEach((label) => {
    //   const labelText = label.textContent;
    //   const checkbox = label.parentElement.querySelector("#checkboxStandard");
    //   const classifYoblige =
    //     label.parentElement.parentElement.querySelector("#Classif").textContent;

    //   if (criteriaCount === regCriteriaNumber) {
    //     allContainDaDat = true;
    //     return;
    //   }

    //   if (classifYoblige === "Khác") {
    //     if (
    //       (labelText.includes("ĐÃ ĐẠT") && !checkbox.checked) ||
    //       (!labelText.includes("ĐÃ ĐẠT") && checkbox.checked)
    //     ) {
    //       criteriaCount++;
    //     }
    //   }

    //   if (
    //     (labelText.includes("ĐÃ ĐẠT") && checkbox.checked) ||
    //     (!labelText.includes("ĐÃ ĐẠT") && !checkbox.checked)
    //   ) {
    //     allContainDaDat = false;
    //   }
    // });

    let shouldBreak = false; // Cờ để kiểm tra xem có nên dừng vòng lặp không

    classifYoblige.forEach((classif) => {
        if (shouldBreak) {
            return; // Nếu cờ shouldBreak là true, thoát vòng lặp
        }

        const classifText = classif.textContent;
        const checkbox =
            classif.parentElement.parentElement.querySelector("#checkboxStandard");
        const labelText = classif.parentElement.parentElement.querySelector(
            ".checkboxQualified__status"
        ).textContent;

        if (classifText !== "Khác") {
            if (
                (labelText.includes("ĐÃ ĐẠT") && checkbox.checked) ||
                (!labelText.includes("ĐÃ ĐẠT") && !checkbox.checked)
            ) {
                allContainDaDat = false;
                console.log(1);
                shouldBreak = true; // Đánh dấu để dừng vòng lặp
            } else {
                allContainDaDat = true;
            }
        } else {
            if (
                (labelText.includes("ĐÃ ĐẠT") && !checkbox.checked) ||
                (!labelText.includes("ĐÃ ĐẠT") && checkbox.checked)
            ) {
                criteriaCount++;
            }
            if (criteriaCount >= regCriteriaNumber) {
                allContainDaDat = true;
                shouldBreak = true; // Đánh dấu để dừng vòng lặp
            } else {
                allContainDaDat = false;
            }
        }
    });

    if (allContainDaDat) {
        console.log("Đúng");
        buttonClicked = 4;
    } else {
        console.log("Sai");
        buttonClicked = 5;
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
//       //Chưa đạt
//       buttonClicked = 5;
//     }
//     if (btn.id === "btn-RegAccept") {
//       //Đạt
//       buttonClicked = 4;
//     }
//     popupConfirmSubmit.style.display = "block";
//   });
// });

// closePopupConfirmSubmit.addEventListener("click", function () {
//   popupConfirmSubmit.style.display = "none";
// });
submitConfirmSubmit.addEventListener("click", function() {
    if (buttonClicked === 4) {
        btnOperation.value = 4;
    }
    if (buttonClicked === 5) {
        btnOperation.value = 5;
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