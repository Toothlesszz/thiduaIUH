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
const openPopupConfirmSubmit = document.querySelector(".btn-ConfirmSubmit");
const closePopupConfirmSubmit = document.querySelector(
    "#close-popupConfirmSubmit"
);
const popupConfirmSubmit = document.querySelector(".popupConfirmSubmit");
const submitConfirmSubmit = document.querySelector("#submit-ConfirmSubmit");
const checkSubmit = document.querySelector("#RegistrationSubmit");

//Xử lí select
// var myVariable = document.getElementById("selectStandard").value;

// setInterval(function () {
//   // Lấy giá trị mới từ phần tử <select>
//   var newVariable = document.getElementById("selectStandard").value;

//   // Kiểm tra giá trị mới của biến
//   if (myVariable !== newVariable) {
//     console.log(newVariable);
//     myVariable = newVariable; // Cập nhật giá trị của myVariable
//     document.getElementById("RegistrationSubmit").submit();
//   }
// }, 100);

//checkboxStandard
const checkboxStandardElement = document.querySelectorAll("#checkboxStandard");

// for (var i = 0; i < checkboxStandardElement.length; i++) {
//   checkboxStandardElement[i].addEventListener("change", function (e) {
//     if (e.target.checked) {
//       var CriteriaItemsElement =
//         e.target.parentElement.parentElement.parentElement.querySelectorAll(
//           ".Criteria"
//         );
//       CriteriaItemsElement.forEach(function (e) {
//         // Thực hiện các thao tác trên từng phần tử ở đây
//         e.style.display = "block";
//         // console.log(e);
//       });
//       // console.log(e.target.parentElement.parentElement.parentElement);
//     } else {
//       var CriteriaItemsElement =
//         e.target.parentElement.parentElement.parentElement.querySelectorAll(
//           ".Criteria"
//         );
//       CriteriaItemsElement.forEach(function (e) {
//         // Thực hiện các thao tác trên từng phần tử ở đây
//         e.style.display = "none";
//         // console.log(e);
//       });
//       // console.log("Bỏ chọn");
//     }
//   });
// }
var regStandardNumber = parseInt(
    document.querySelector("#regStandardNumber").textContent
);

for (var i = 0; i < checkboxStandardElement.length; i++) {
    checkboxStandardElement[i].addEventListener("change", function(e) {
        var checkedCheckboxCount = 0;

        for (var j = 0; j < checkboxStandardElement.length; j++) {
            if (checkboxStandardElement[j].checked) {
                checkedCheckboxCount++;
            }
        }
        if (checkedCheckboxCount === regStandardNumber) {
            for (var k = 0; k < checkboxStandardElement.length; k++) {
                if (checkboxStandardElement[k] !== e.target) {
                    checkboxStandardElement[k].disabled = true;
                }
            }
        } else {
            for (var k = 0; k < checkboxStandardElement.length; k++) {
                checkboxStandardElement[k].disabled = false;
            }
        }

        // Thêm đoạn mã của bạn để xử lý hiển thị/ẩn các phần tử .Criteria
        if (e.target.checked) {
            var CriteriaItemsElement =
                e.target.parentElement.parentElement.parentElement.querySelectorAll(
                    ".Criteria"
                );
            CriteriaItemsElement.forEach(function(e) {
                // Thực hiện các thao tác trên từng phần tử ở đây
                e.style.display = "block";
                // console.log(e);
            });
            // console.log(e.target.parentElement.parentElement.parentElement);
        } else {
            var CriteriaItemsElement =
                e.target.parentElement.parentElement.parentElement.querySelectorAll(
                    ".Criteria"
                );
            CriteriaItemsElement.forEach(function(e) {
                // Thực hiện các thao tác trên từng phần tử ở đây
                e.style.display = "none";
                // console.log(e);
            });
            // console.log("Bỏ chọn");
        }
    });
}

//
// openPopupConfirmSubmit.addEventListener("click", function (event) {
//   var checkboxes = document.querySelectorAll(
//     '.Standard__Items input[type="checkbox"]'
//   );
//   var allInputsValid = true;
//   var atLeastOneCheckboxChecked = false;
//   var emptyTextareaCount = 0;
//   // var emptyInputCount = 0;
//   for (var i = 0; i < checkboxes.length; i++) {
//     if (checkboxes[i].checked) {
//       atLeastOneCheckboxChecked = true;
//       var parentElement = checkboxes[i].parentElement.parentElement;
//       console.log(parentElement);
//       // var inputElements = parentElement.parentElement.querySelectorAll("input");
//       var textareaElements =
//         parentElement.parentElement.querySelectorAll("textarea");
//       var regCriteriaNumber = parseInt(
//         parentElement.parentElement.querySelector("#regCriteriaNumber")
//           .textContent
//       );
//       console.log(
//         parseInt(
//           parentElement.parentElement.querySelector("#regCriteriaNumber")
//             .textContent
//         )
//       );

//       // inputElements.forEach(function (inputElement) {
//       //   if (inputElement.required && !inputElement.checkValidity()) {
//       //     // Kiểm tra nếu phần tử input cụ thể bắt buộc chưa được điền giá trị hợp lệ
//       //     console.log(
//       //       "Phần tử input bắt buộc chưa điền giá trị hợp lệ:",
//       //       inputElement
//       //     );
//       //     allInputsValid = false;
//       //   }
//       //   if (!inputElement.inputElement && inputElement.value.trim() !== "") {
//       //     emptyInputCount++;
//       //   }
//       // });
//       // console.log(emptyInputCount);
//       textareaElements.forEach(function (textareaElement) {
//         if (textareaElement.required && !textareaElement.checkValidity()) {
//           // Kiểm tra nếu phần tử textarea cụ thể bắt buộc chưa được điền giá trị hợp lệ
//           console.log(
//             "Phần tử textarea bắt buộc chưa điền giá trị hợp lệ:",
//             textareaElement
//           );
//           allInputsValid = false;
//           MessageError(
//             "KHÔNG THỂ ĐĂNG KÝ!",
//             "Vui lòng nhập đầy đủ 'Tiêu chí bắt buộc'."
//           );
//         }
//         if (!textareaElement.required && textareaElement.value.trim() !== "") {
//           emptyTextareaCount++;
//         }
//       });
//       console.log(emptyTextareaCount);
//       if (emptyTextareaCount < regCriteriaNumber) {
//         MessageError(
//           "KHÔNG THỂ ĐĂNG KÝ!",
//           "Vui lòng nhập đầy đủ 'Tiêu chí khác'."
//         );
//         allInputsValid = false;
//       }
//       // Nếu có phần tử không hợp lệ, ngăn chặn submit form và không hiển thị popupConfirmSubmit
//       if (!allInputsValid) {
//         event.preventDefault(); // Ngăn chặn submit form
//         return;
//       }
//     }
//   }
//   // Nếu tất cả các phần tử đều hợp lệ, hiển thị popupConfirmSubmit
//   if (allInputsValid && atLeastOneCheckboxChecked) {
//     event.preventDefault(); // Ngăn chặn submit form

//     popupConfirmSubmit.style.display = "block";
//   } else {
//     event.preventDefault(); // Ngăn chặn submit form
//     MessageError(
//       "KHÔNG THỂ ĐĂNG KÝ!",
//       "Vui lòng chọn tiêu chuẩn để đăng kí danh hiệu."
//     );
//   }
// });

openPopupConfirmSubmit.addEventListener("click", function(event) {
    event.preventDefault(); // Ngăn chặn submit form

    var checkboxes = document.querySelectorAll(
        '.Standard__Items input[type="checkbox"]'
    );
    var checkboxValidities = []; // Mảng lưu trạng thái hợp lệ của từng checkbox
    var allInputsValid = true;
    var emptyTextareaCount = 0;
    var atLeastOneCheckboxChecked = 0;

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            atLeastOneCheckboxChecked++;
            var parentElement = checkboxes[i].parentElement.parentElement;
            console.log(parentElement);
            var Answer =
                parentElement.parentElement.querySelectorAll(".Criteria__Items");
            console.log(
                parentElement.parentElement.querySelector(".Criteria__Items")
            );

            var regCriteriaNumber = parseInt(
                parentElement.parentElement.querySelector("#regCriteriaNumber")
                .textContent
            );

            var allInputsValidForCheckbox = true;
            var emptyTextareaCountForCheckbox = 0;

            Answer.forEach(function(Answer) {
                var textareaElement = Answer.querySelector("textarea");
                var inputElement = Answer.querySelector("input[type='file']");
                console.log(inputElement.required);
                if (
                    (textareaElement.required && textareaElement.value.trim() === "") ||
                    (inputElement.required && inputElement.value === "")
                ) {
                    console.log(
                        "Phần tử textarea bắt buộc chưa điền giá trị hợp lệ:",
                        textareaElement
                    );
                    allInputsValidForCheckbox = false;
                    MessageError(
                        "KHÔNG THỂ ĐĂNG KÝ!",
                        "Vui lòng nhập đầy đủ 'Tiêu chí bắt buộc' và minh chứng."
                    );
                }
                if (!textareaElement.required &&
                    textareaElement.value.trim() !== "" &&
                    !inputElement.required &&
                    inputElement.value !== ""
                ) {
                    emptyTextareaCountForCheckbox++;
                }
            });

            if (emptyTextareaCountForCheckbox < regCriteriaNumber) {
                MessageError(
                    "KHÔNG THỂ ĐĂNG KÝ!",
                    "Vui lòng nhập đầy đủ 'Tiêu chí khác' và minh chứng."
                );
                allInputsValidForCheckbox = false;
            }

            checkboxValidities[i] = allInputsValidForCheckbox; // Lưu trạng thái hợp lệ của checkbox hiện tại
            emptyTextareaCount += emptyTextareaCountForCheckbox;

            if (!allInputsValidForCheckbox) {
                allInputsValid = false;
            }
        } else {
            checkboxValidities[i] = true; // Checkbox không được chọn được coi là hợp lệ
        }
    }

    // Kiểm tra trạng thái hợp lệ của tất cả các checkbox
    var allCheckboxesValid = checkboxValidities.every(function(valid) {
        return valid;
    });

    if (
        allInputsValid &&
        allCheckboxesValid &&
        atLeastOneCheckboxChecked == regStandardNumber
    ) {
        event.preventDefault(); // Ngăn chặn submit form
        popupConfirmSubmit.style.display = "block";
    } else if (atLeastOneCheckboxChecked < regStandardNumber) {
        event.preventDefault(); // Ngăn chặn submit form
        MessageError(
            "KHÔNG THỂ ĐĂNG KÝ!",
            "Vui lòng đăng ký đủ Tiêu chuẩn' để đăng kí danh hiệu."
        );
    }
});

// openPopupConfirmSubmit.addEventListener("click", function (event) {
//   event.preventDefault(); // Ngăn chặn submit form

//   var checkboxes = document.querySelectorAll(
//     '.Standard__Items input[type="checkbox"]'
//   );
//   var checkboxValidities = []; // Mảng lưu trạng thái hợp lệ của từng checkbox
//   var allInputsValid = true;
//   var emptyTextareaCount = 0;
//   var atLeastOneCheckboxChecked = 0;

//   for (var i = 0; i < checkboxes.length; i++) {
//     if (checkboxes[i].checked) {
//       atLeastOneCheckboxChecked++;
//       var parentElement = checkboxes[i].parentElement.parentElement;
//       console.log(parentElement);
//       var textareaElements =
//         parentElement.parentElement.querySelectorAll("textarea");
//       console.log(
//         parentElement.parentElement.querySelector(".Criteria__Items")
//       );

//       var regCriteriaNumber = parseInt(
//         parentElement.parentElement.querySelector("#regCriteriaNumber")
//           .textContent
//       );

//       var allInputsValidForCheckbox = true;
//       var emptyTextareaCountForCheckbox = 0;

//       textareaElements.forEach(function (textareaElement) {
//         if (textareaElement.required && !textareaElement.checkValidity()) {
//           console.log(
//             "Phần tử textarea bắt buộc chưa điền giá trị hợp lệ:",
//             textareaElement
//           );
//           allInputsValidForCheckbox = false;
//           MessageError(
//             "KHÔNG THỂ ĐĂNG KÝ!",
//             "Vui lòng nhập đầy đủ 'Tiêu chí bắt buộc'."
//           );
//         }
//         if (!textareaElement.required && textareaElement.value.trim() !== "") {
//           emptyTextareaCountForCheckbox++;
//         }
//       });

//       if (emptyTextareaCountForCheckbox < regCriteriaNumber) {
//         MessageError(
//           "KHÔNG THỂ ĐĂNG KÝ!",
//           "Vui lòng nhập đầy đủ 'Tiêu chí khác'."
//         );
//         allInputsValidForCheckbox = false;
//       }

//       checkboxValidities[i] = allInputsValidForCheckbox; // Lưu trạng thái hợp lệ của checkbox hiện tại
//       emptyTextareaCount += emptyTextareaCountForCheckbox;

//       if (!allInputsValidForCheckbox) {
//         allInputsValid = false;
//       }
//     } else {
//       checkboxValidities[i] = true; // Checkbox không được chọn được coi là hợp lệ
//     }
//   }

//   // Kiểm tra trạng thái hợp lệ của tất cả các checkbox
//   var allCheckboxesValid = checkboxValidities.every(function (valid) {
//     return valid;
//   });

//   if (
//     allInputsValid &&
//     allCheckboxesValid &&
//     atLeastOneCheckboxChecked == regStandardNumber
//   ) {
//     event.preventDefault(); // Ngăn chặn submit form
//     popupConfirmSubmit.style.display = "block";
//   } else if (atLeastOneCheckboxChecked < regStandardNumber) {
//     event.preventDefault(); // Ngăn chặn submit form
//     MessageError(
//       "KHÔNG THỂ ĐĂNG KÝ!",
//       "Vui lòng đăng ký đủ Tiêu chuẩn' để đăng kí danh hiệu."
//     );
//   }
// });

// openPopupConfirmSubmit.addEventListener("click", function (e) {
//   //   popupConfirmSubmit.style.display = "block";
//   if (checkSubmit.checkValidity()) {
//     // Nếu form không hợp lệ, chặn sự kiện submit và hiển thị thông báo lỗi
//     e.preventDefault();
//     popupConfirmSubmit.style.display = "block";
//   }
// });
closePopupConfirmSubmit.addEventListener("click", function() {
    popupConfirmSubmit.style.display = "none";
});

let isButtonDisabled = false;

submitConfirmSubmit.addEventListener("click", function(e) {
    e.preventDefault(); // Ngăn chặn hành vi mặc định của form

    var checkboxes2 = document.querySelectorAll('input[type="checkbox"]');
    checkboxes2.forEach(function(checkbox) {
        if (!checkbox.checked) {
            var parent2 = checkbox.parentElement.parentElement.parentNode;
            var criteriaItems = parent2.querySelectorAll(".Criteria__Items");

            criteriaItems.forEach(function(item) {
                var TextareaElement = item.querySelector("textarea");
                var InputElement = item.querySelector("input[type='file']");
                var InputElementHiden = item.querySelector("input[type='hidden']");
                console.log(InputElement);
                TextareaElement.removeAttribute("name");
                InputElement.removeAttribute("name");
                InputElementHiden.removeAttribute("name");
            });
        }
        if (checkbox.checked) {
            var parent3 = checkbox.parentElement.parentElement.parentNode;
            var criteriaItems = parent3.querySelectorAll(".Criteria__Items");

            criteriaItems.forEach(function(item) {
                var TextareaElement = item.querySelector("textarea");
                var InputElement = item.querySelector("input[type='file']");
                var InputElementHiden = item.querySelector("input[type='hidden']");
                console.log(InputElement);
                if (TextareaElement.value.trim() === "" || InputElement.value === "") {
                    TextareaElement.removeAttribute("name");
                    InputElement.removeAttribute("name");
                    InputElementHiden.removeAttribute("name");
                }
            });
        }
    });
    if (!isButtonDisabled) {
        // Đánh dấu nút là đã bị vô hiệu hóa
        isButtonDisabled = true;

        // Thực hiện hành động bạn muốn thực hiện
        // Ví dụ: Gửi dữ liệu, thực hiện công việc, vv.

        // Tiếp tục xử lý dữ liệu và gửi form lên server
        checkSubmit.submit();
        // Sau một khoảng thời gian, kích hoạt lại nút
        setTimeout(function() {
            isButtonDisabled = false;
        }, 5000); // 5000 milliseconds (5 giây)
    }
});