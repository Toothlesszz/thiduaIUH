const btnViewCertification = document.querySelector("#btn-Certification");

const openPopup = document.querySelector("#btn-ViewCertification");
const closePopup = document.querySelector("#closePopup");
const popupContainer = document.querySelector(".popupCertification");
const DownloadCertification = document.querySelector(
    "#btn-DownloadCertification"
);

openPopup.addEventListener("click", function() {
    popupContainer.style.display = "block";
});

closePopup.addEventListener("click", function() {
    popupContainer.style.display = "none";
});
//
DownloadCertification.addEventListener("click", function generatePDF() {
    // Tạo một đối tượng jsPDF
    const { jsPDF } = window.jspdf;

    const doc = new jsPDF();

    // Lấy nội dung của phần tử có id="content"
    const content = document.querySelector(
        ".popupCertification__content--Certification"
    );
    //Tăng kích thước thẻ Html
    window.devicePixelRatio = 4;
    // content.style.width = "2122px";
    //Lấy kích thước PDF
    var pdfWidth = doc.internal.pageSize.getWidth();
    var pdfHeight = doc.internal.pageSize.getHeight();
    // Sử dụng phương thức html() để chuyển đổi nội dung HTML thành PDF
    html2canvas(content).then((canvas) => {
        // Chuyển đổi hình ảnh thành định dạng PDF và thêm vào đối tượng jsPDF
        doc.addImage(
            canvas.toDataURL("image/png"),
            "PNG",
            0,
            0,
            pdfWidth,
            pdfHeight
        );

        // Lưu file PDF với tên my-pdf.pdf
        doc.save("[IUH]ChungNhan.pdf");
        // let newTab = window.open();
        // newTab.location.href = "path/to/file.pdf";
        // doc.output("dataurlnewwindow");
        // doc.autoPrint();
        // window.open(doc.output("datauristring"));
        // var blob = doc.output("blob");
        // window.open(URL.createObjectURL(blob));
    });
});

// const inputElement = document.querySelectorAll(".ChangePass__items input");
// const inputElementPassword = document.querySelector(".ChangePass__items #pass");
// const eyeOpen = document.querySelectorAll(".eye-open");
// const eyeClose = document.querySelectorAll(".eye-close");
// const submitButton = document.querySelector("#btn-changePass");

// //Kiểm tra
// for (var i = 0; i < inputElement.length; i++) {
//   inputElement[i].onblur = function (e) {
//     // console.log(e.target.value);
//     if (!e.target.value) {
//       e.target.parentElement.querySelector(
//         ".ChangePass__items span"
//       ).innerHTML =
//         '<i class="fa-solid fa-triangle-exclamation"></i> <span>Vui lòng nhập vào trường này !</span>';

//       e.target.classList.add("input-danger");
//     } else {
//       ArrayinputElement = Array.from(inputElement);

//       switch (ArrayinputElement.indexOf(e.target)) {
//         // case 0: {
//         //   e.target.parentElement.querySelector("#message").innerHTML =
//         //     validationPass(e.target);
//         //   break;
//         // }
//         case 0: {
//           e.target.parentElement.querySelector("#message").innerHTML =
//             validationNewPass(e.target);
//           break;
//         }
//         case 1: {
//           e.target.parentElement.querySelector("#message").innerHTML =
//             validationRepeatPass(e.target);
//           break;
//         }
//       }
//     }
//   };
//   inputElement[i].onfocus = function (e) {
//     e.target.parentElement.querySelector(".ChangePass__items span").innerHTML =
//       "";
//   };
// }

// // function validationPass(isPass) {
// //   var regPass =
// //     /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
// //   if (!regPass.test(isPass.value)) {
// //     isPass.classList.add("input-danger");
// //     validationFormPass = false;
// //     return "Tối thiểu tám ký tự, ít nhất một chữ cái, một số và một ký tự đặc biệt.";
// //   } else {
// //     isPass.classList.remove("input-danger");
// //     validationFormPass = true;
// //     return "";
// //   }
// // }
// function validationNewPass(isNewPass) {
//   var RePassElement = document.querySelector("#RePass");
//   var regPass =
//     /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/;
//   if (!regPass.test(isNewPass.value)) {
//     isNewPass.classList.add("input-danger");
//     validationFormNewPass = false;
//     RePassElement.classList.remove("input-danger");
//     RePassElement.parentElement.querySelector("#message").innerHTML = "";
//     validationFormRePass = true;
//     return "Tối thiểu sáu ký tự, ít nhất một chữ cái, một số và một ký tự đặc biệt.";
//   }
//   //Xử lý RePass
//   else if (RePassElement.value && RePassElement.value != isNewPass.value) {
//     isNewPass.classList.remove("input-danger");
//     validationFormRePass = false;
//     RePassElement.classList.add("input-danger");
//     RePassElement.parentElement.querySelector("#message").innerHTML =
//       "Mật khẩu không trùng khớp.";
//     return "";
//   } else {
//     isNewPass.classList.remove("input-danger");
//     validationFormNewPass = true;
//     //Xử lý RePass
//     RePassElement.classList.remove("input-danger");
//     RePassElement.parentElement.querySelector("#message").innerHTML = "";
//     validationFormRePass = true;
//     return "";
//   }
// }
// function validationRepeatPass(isRePass) {
//   var PassWord = document.querySelector("#NewPass").value;
//   if (!PassWord) {
//     isRePass.classList.add("input-danger");
//     validationFormRePass = false;
//     return "Vui lòng nhập mật khẩu";
//   } else if (isRePass.value == PassWord) {
//     isRePass.classList.remove("input-danger");
//     validationFormRePass = true;
//     return "";
//   } else {
//     isRePass.classList.add("input-danger");
//     validationFormRePass = false;
//     validationFormNewPass = true;
//     return "Mật khẩu không trùng khớp.";
//   }
// }

// //Ẩn hiện mật khẩu
// for (var a = 0; a < eyeOpen.length; a++) {
//   eyeOpen[a].addEventListener("click", function (e) {
//     e.target.classList.add("hidden");
//     console.log(e.target.parentElement.parentElement);
//     e.target.parentElement.parentElement
//       .querySelector(".ChangePass__items .eye-close")
//       .classList.remove("hidden");
//     e.target.parentElement.parentElement
//       .querySelector(".ChangePass__items input")
//       .setAttribute("type", "password");
//   });
// }
// for (var a = 0; a < eyeClose.length; a++) {
//   eyeClose[a].addEventListener("click", function (e) {
//     e.target.classList.add("hidden");
//     e.target.parentElement.parentElement
//       .querySelector(".ChangePass__items .eye-open")
//       .classList.remove("hidden");
//     e.target.parentElement.parentElement
//       .querySelector(".ChangePass__items input")
//       .setAttribute("type", "text");
//   });
// }

// //Validation Form
// // var validationFormPass = false;
// var validationFormNewPass = false;
// var validationFormRePass = false;

// submitButton.addEventListener("click", (event) => {
//   if (
//     // validationFormPass == false ||
//     validationFormNewPass == false ||
//     validationFormRePass == false
//   ) {
//     event.preventDefault();
//     // alert("Mã ứng viên hoặc Mật khẩu không chính xác!");
//     for (var i = 0; i < inputElement.length; i++) {
//       if (!inputElement[i].value) {
//         inputElement[i].parentElement.querySelector(
//           ".ChangePass__items span"
//         ).innerHTML =
//           '<i class="fa-solid fa-triangle-exclamation"></i> <span>Vui lòng nhập vào trường này !</span>';

//         inputElement[i].parentElement
//           .querySelector(".ChangePass__items input")
//           .classList.add("input-danger");
//       }
//     }
//   }
// });