//Select Custom
var selects = document.querySelectorAll("select");
// var selectsIcon = document.querySelectorAll("#selectIcon");

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
                // activeSelect.classList.remove("active");
                activeSelect.nextElementSibling.style.display = "none";
            }
        }
        selectStyled.classList.toggle("active");
        // selectsIcon.classList.toggle("fa-rotate-90");
        // selectsIcon.classList.toggle("fa-rotate-270");
        list.style.display = list.style.display === "none" ? "block" : "none";
    });

    for (var i = 0; i < listItems.length; i++) {
        var listItem = listItems[i];
        listItem.addEventListener("click", function(e) {
            e.stopPropagation();
            selectStyled.textContent = this.textContent;
            selectStyled.classList.remove("active");
            select.value = this.getAttribute("rel");
            // selectsIcon.classList.add("fa-rotate-90");
            // selectsIcon.classList.remove("fa-rotate-270");
            list.style.display = "none";
        });
    }

    document.addEventListener("click", function() {
        selectStyled.classList.remove("active");
        // selectsIcon.classList.add("fa-rotate-90");
        // selectsIcon.classList.remove("fa-rotate-270");
        list.style.display = "none";
    });
});

//
const candidateObject = document.querySelector("#candidateObject");
const IDCandidate = document.querySelector("#IDCandidate input");
const courseCandidate = document.querySelector("#courseCandidate input");

// console.log(candidateObject.value);
IDCandidate.addEventListener("input", function(event) {
    var inputValue = event.target.value;
    console.log("Giá trị đã nhập: " + inputValue);
    if (parseInt(inputValue.substring(0, 2)) > 9) {
        var startYear = parseInt(inputValue.substring(0, 2));
        var endYear = startYear + 4;
        courseCandidate.value = "20" + startYear + " - " + "20" + endYear;
    } else {
        courseCandidate.value = "";
    }
});
//
// const testtoast = document.querySelector("#testtoast");

// testtoast.addEventListener("click", function () {
//   // Lưu trạng thái
//   sessionStorage.setItem("reloadStatus", "true");

//   // Thực hiện reload trang
//   location.reload();
// });

// window.addEventListener("load", function () {
//   // Kiểm tra trạng thái đã được lưu trữ
//   var reloadStatus = sessionStorage.getItem("reloadStatus");

//   if (reloadStatus === "true") {
//     // Thực thi mã JavaScript sau khi trang reload
//     Toastify({
//       text: "THÔNG BÁO: ID hoặc mật khẩu không chính xác!",
//       duration: 3000,
//       newWindow: true,
//       close: true,
//       gravity: "top",
//       position: "right",
//       backgroundColor: "linear-gradient(to right,#F03F3F, #FF616D)",
//       stopOnFocus: true,
//     }).showToast();

//     // Xóa trạng thái đã được lưu trữ
//     sessionStorage.removeItem("reloadStatus");
//   }
// });

// Lắng nghe sự kiện khi người dùng chọn tệp Excel
document
    .getElementById("excel-file")
    .addEventListener("change", handleFile, false);

// Hàm xử lý tệp Excel
function handleFile(e) {
    var file = e.target.files[0];
    var reader = new FileReader();

    // Đọc nội dung của tệp Excel
    reader.onload = function(e) {
        var data = new Uint8Array(e.target.result);
        var workbook = XLSX.read(data, { type: "array" });

        // Lấy dữ liệu từ trang tính đầu tiên trong tệp Excel
        var worksheet = workbook.Sheets[workbook.SheetNames[0]];

        // Chuyển đổi dữ liệu từ trang tính thành mảng các đối tượng
        var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

        // Tạo bảng HTML từ dữ liệu Excel
        var table = document.createElement("table");
        for (var i = 0; i < jsonData.length; i++) {
            var row = table.insertRow();
            for (var j = 0; j < jsonData[i].length; j++) {
                var cell = row.insertCell();
                cell.innerHTML = jsonData[i][j];
            }
        }

        // Hiển thị bảng trong thẻ div
        var tableContainer = document.getElementById("ExcelTable-container");
        tableContainer.innerHTML = "";
        tableContainer.appendChild(table);
        // document.querySelector("#btn-excelFile").style.backgroundColor =
        //   "rgba(29, 171, 161, 1)";
    };

    reader.readAsArrayBuffer(file);
}

document
    .querySelector("#closePopup-ExcelTable")
    .addEventListener("click", function() {
        document.querySelector(".Popup-ExcelTable").style.display = "none";
    });
document
    .querySelector("#openPopup-ExcelTable")
    .addEventListener("click", function() {
        document.querySelector(".Popup-ExcelTable").style.display = "block";
    });