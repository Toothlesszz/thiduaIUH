//UpLoad Hình ảnh
// Get the input element and submit button
const fileInput = document.querySelector("#FileInput");

// Add an event listener to the input element
var checkType2 = false;
fileInput.addEventListener("input", function(e) {
    // Get the file object from the input element
    const file = e.target.files[0];
    const fileType = file.type;
    if (fileType != "image/png" && fileType != "image/jpeg") {
        e.target.value = "";
        checkType2 = false;
        MessageImgError(
            " Lỗi UPLOAD hình ảnh!",
            "Định dạng File được chọn phải là 'jpeg' hoặc 'png'."
        );
    } else {
        // Create a FileReader object to read the file
        const reader = new FileReader();
        checkType2 = true;
        // Set up the FileReader object to handle the load event
        reader.onload = function() {
            // Add the image element to the preview div
            const preview = document.querySelector("#DefaultImg");
            preview.src = URL.createObjectURL(file);
            //   preview.appendChild(img);
        };

        // Read the file as a data URL
        reader.readAsDataURL(file);
    }
});

//Message
const mainElement = document.querySelector(".MainMessage");

function MessageImgError(Title, Mess) {
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
         ${Title}
        </p>
        <p class="message__content--note">
          ${Mess}
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

//
tinymce.init({
    selector: "textarea",
    plugins: "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss",
    menubar: false,
    toolbar: "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat",
    tinycomments_mode: "embedded",
    tinycomments_author: "Author name",
    mergetags_list: [
        { value: "First.Name", title: "First Name" },
        { value: "Email", title: "Email" },
    ],
});
//

const MedalDescriptionName = document.querySelector(
    ".MedalDescription__Name input"
);

MedalDescriptionName.addEventListener("input", function() {
    this.style.width = this.value.length + 2 + "ch";
});
//UpLoad Hình ảnh chứng nhận
// Get the input element and submit button
const fileInputTemplateMedal = document.querySelector("#TemplateMedal");
// const UploadImg = document.querySelector("#btn-UploadImg");

// Add an event listener to the input element
var checkType1 = false;
fileInputTemplateMedal.addEventListener("input", function(e) {
    // Get the file object from the input element
    const filefileInputTemplateMedal = e.target.files[0];
    const fileTypefileInputTemplateMedal = filefileInputTemplateMedal.type;

    if (
        fileTypefileInputTemplateMedal != "image/png" &&
        fileTypefileInputTemplateMedal != "image/jpeg"
    ) {
        MessageImgError(
            "UPLOAD FILE KHÔNG THÀNH CÔNG!",
            "Vui lòng chọn file mẫu chứng nhận có định dạng là jpeg/png"
        );
        e.target.value = "";
        StyleProof1(
            "transparent",
            "<i class='fa-solid fa-file-arrow-up'></i> CHỨNG NHẬN",
            "rgba(155, 155, 155, 1)"
        );
        checkType1 = false;
    } else {
        // Create a FileReader object to read the file
        checkType1 = true;

        StyleProof1(
            "rgba(29, 171, 161, 1)",
            "<i class='fa-solid fa-file-image'></i> ĐÃ CHỌN FILE!",
            "rgb(255, 255, 255)"
        );
        // Read the file as a data URL
    }
});

function StyleProof1(Color, Text, TextColor) {
    document.querySelector(".UploadTemplateMedal").style.backgroundColor = Color;
    document.querySelector(".UploadTemplateMedal span").innerHTML = Text;
    document.querySelector(".UploadTemplateMedal span").style.color = TextColor;
}

//UpLoad File danh hiệu
// Get the input element and submit button
const fileInputInstructMedal = document.querySelector("#InstructMedal");
// const UploadImg = document.querySelector("#btn-UploadImg");

// Add an event listener to the input element
var checkType = false;
fileInputInstructMedal.addEventListener("input", function(e) {
    // Get the file object from the input element
    const fileInstructMedal = e.target.files[0];
    const fileTypeInstructMedal = fileInstructMedal.type;

    if (fileTypeInstructMedal != "application/pdf") {
        MessageImgError(
            "UPLOAD FILE KHÔNG THÀNH CÔNG!",
            "Vui lòng chọn file có định dạng là PDF"
        );
        e.target.value = "";
        StyleProof(
            "rgba(155, 155, 155, 1)",
            "<i class='fa-solid fa-file-arrow-up'></i> UPLOAD FILE HƯỚNG DẪN"
        );
        checkType = false;
    } else {
        // Create a FileReader object to read the file
        checkType = true;

        StyleProof(
            "rgba(29, 171, 161, 1)",
            "<i class='fa-solid fa-file-pdf'></i> ĐÃ CHỌN FILE!"
        );
        // Read the file as a data URL
    }
});

function StyleProof(Color, Text) {
    document.querySelector(
        ".MedalDescription__Object--Upload"
    ).style.backgroundColor = Color;
    document.querySelector(".MedalDescription__Object--Upload span").innerHTML =
        Text;
}

//Create Criteria
const StandardElement = document.querySelectorAll(".CreateMedalReg__Standard");
let AddCriteria = document.querySelectorAll(".AddCriteria");

function performLoopOnNewElements() {
    for (var i = 0; i < AddCriteria.length; i++) {
        AddCriteria[i].onclick = function(e) {
            // console.log(AddCriteria);
            var indexStandard = parseInt(
                e.target.parentElement.querySelector("#IndexStandard").textContent
            );
            console.log(indexStandard);
            const newCriteriaElement = document.createElement("div");
            newCriteriaElement.classList.add("CreateMedalReg__Standard--Criteria");
            newCriteriaElement.innerHTML = `<div class="CriteriaClassify">
        <span>Tiêu chí</span>
        <div class="custom-Select">
          <div class="custom-Select__Title">
          <i class="fa-solid fa-tags"></i>
            <span id="">Phân loại</span>
          </div>
  
          <select name="criterias[${indexStandard}][number][]" id="">
            <option value="1">Tiêu chí khác</option>
            <option value="2">Tiêu chí bắt buộc</option>
          </select>
        </div>
      </div>
      <textarea name="criterias[${indexStandard}][details][]" id=""></textarea>`;
            e.target.parentElement.appendChild(newCriteriaElement);

            //
            tinymce.init({
                selector: "textarea",
                plugins: "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss",
                menubar: false,
                toolbar: "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat",
                tinycomments_mode: "embedded",
                tinycomments_author: "Author name",
                mergetags_list: [
                    { value: "First.Name", title: "First Name" },
                    { value: "Email", title: "Email" },
                ],
            });
            //
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
                    var activeSelects = document.querySelectorAll(
                        ".select-styled .active"
                    );
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
        };
    }
}
for (var i = 0; i < AddCriteria.length; i++) {
    AddCriteria[i].onclick = function(e) {
        // console.log(AddCriteria);
        var indexStandard = parseInt(
            e.target.parentElement.querySelector("#IndexStandard").textContent
        );
        console.log(indexStandard);
        const newCriteriaElement = document.createElement("div");
        newCriteriaElement.classList.add("CreateMedalReg__Standard--Criteria");
        newCriteriaElement.innerHTML = `<div class="CriteriaClassify">
      <span>Tiêu chí</span>
      <div class="custom-Select">
        <div class="custom-Select__Title">
        <i class="fa-solid fa-tags"></i>
          <span id="">Phân loại</span>
        </div>

        <select name="criterias[${indexStandard}][number][]" id="">
          <option value="1">Tiêu chí khác</option>
          <option value="2">Tiêu chí bắt buộc</option>
        </select>
      </div>
    </div>
    <textarea name="criterias[${indexStandard}][details][]" id=""></textarea>`;
        e.target.parentElement.appendChild(newCriteriaElement);

        //
        tinymce.init({
            selector: "textarea",
            plugins: "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss",
            menubar: false,
            toolbar: "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat",
            tinycomments_mode: "embedded",
            tinycomments_author: "Author name",
            mergetags_list: [
                { value: "First.Name", title: "First Name" },
                { value: "Email", title: "Email" },
            ],
        });
        //
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
    };
}
//Create Standard

const AddStandard = document.querySelector(".AddStandard");
const MedalRegElemant = document.querySelector(".CreateMedalReg");
var indexStandardNew = 1;
AddStandard.addEventListener("click", function() {
    const newStandardElement = document.createElement("div");
    newStandardElement.classList.add("CreateMedalReg__Standard");
    newStandardElement.innerHTML = `<p id="IndexStandard" hidden>${indexStandardNew}</p>
  <div class="StandardName">
  <span
    >TÊN TIÊU CHUẨN <i class="fa-solid fa-square-pen"></i
  ></span>
  <input type="text" name="criterias[${indexStandardNew}][name]"/>
</div>
<div class="StandardInstruct">
  <h5>Hướng dẫn</h5>
  <textarea name="criterias[${indexStandardNew}][intruction][]" id="" cols="30" rows="10"></textarea>
</div>
<div class="MedalDescription__quantityInput">
  <h4>Số "Tiêu chí khác" phải đăng ký</h4>
  <div class="quantityInput">
    <button
      class="qty-count qty-count--minus"
      data-action="minus"
      type="button"
    >
      -
    </button>
    <input
      class="product-qty"
      type="number"
      name="criterias[${indexStandardNew}][criteriasnumber][]"
      min="0"
      max="100"
      value="1"
    />
    <button
      class="qty-count qty-count--add"
      data-action="add"
      type="button"
    >
      +
    </button>
  </div>
</div>
<div class="CreateMedalReg__Standard--Criteria">
  <div class="CriteriaClassify">
    <span>Tiêu chí</span>
    <div class="custom-Select">
      <div class="custom-Select__Title">
        <i class="fa-solid fa-tags"></i>
        <span id="">Phân loại</span>
      </div>

      <select name="criterias[${indexStandardNew}][number][]" id="">
        <option value="1">Tiêu chí khác</option>
        <option value="2">Tiêu chí bắt buộc</option>
      </select>
    </div>
  </div>
  <textarea name="criterias[${indexStandardNew}][details][]" id=""></textarea>
</div>
<div class="AddCriteria">
  <span
    >Thêm tiêu chí <i class="fa-solid fa-circle-plus"></i
  ></span>
</div>`;
    indexStandardNew++;
    MedalRegElemant.appendChild(newStandardElement);
    AddCriteria = document.querySelectorAll(".AddCriteria");
    performLoopOnNewElements();
    //
    tinymce.init({
        selector: "textarea",
        plugins: "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss",
        menubar: false,
        toolbar: "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat",
        tinycomments_mode: "embedded",
        tinycomments_author: "Author name",
        mergetags_list: [
            { value: "First.Name", title: "First Name" },
            { value: "Email", title: "Email" },
        ],
    });
    //
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
    var QtyInput = (function() {
        var qtyInputs = document.querySelectorAll(".quantityInput");

        if (!qtyInputs.length) {
            return;
        }

        var inputs = document.querySelectorAll(".product-qty");
        var countBtns = document.querySelectorAll(".qty-count");
        var qtyMin = parseInt(inputs[0].getAttribute("min"));
        var qtyMax = parseInt(inputs[0].getAttribute("max"));

        Array.from(inputs).forEach(function(input) {
            input.addEventListener("change", function() {
                var thisInput = this;
                var minusBtn = thisInput.nextElementSibling.previousElementSibling;
                var addBtn = thisInput.nextElementSibling;
                var qty = parseInt(thisInput.value);

                if (isNaN(qty) || qty <= qtyMin) {
                    thisInput.value = qtyMin;
                    minusBtn.disabled = true;
                } else {
                    minusBtn.disabled = false;

                    if (qty >= qtyMax) {
                        thisInput.value = qtyMax;
                        addBtn.disabled = true;
                    } else {
                        thisInput.value = qty;
                        addBtn.disabled = false;
                    }
                }
            });
        });

        Array.from(countBtns).forEach(function(btn) {
            btn.addEventListener("click", function() {
                var operator = this.dataset.action;
                var thisBtn = this;
                var parent = thisBtn.parentNode;
                var input = parent.querySelector(".product-qty");
                var qty = parseInt(input.value);

                if (operator === "add") {
                    qty += 1;
                    if (qty >= qtyMin + 1) {
                        parent.querySelector(".qty-count--minus").disabled = false;
                    }

                    if (qty >= qtyMax) {
                        thisBtn.disabled = true;
                    }
                } else if (operator === "minus") {
                    qty = qty <= qtyMin ? qtyMin : (qty -= 1);

                    if (qty === qtyMin) {
                        thisBtn.disabled = true;
                    }

                    if (qty < qtyMax) {
                        parent.querySelector(".qty-count--add").disabled = false;
                    }
                }

                input.value = qty;
                parent.querySelector(".qty-count--minus").disabled = qty === qtyMin;
            });
        });
    })();
});

//
const showCreateMedal = document.querySelector(".showCreateMedal");
const iconShow = document.querySelector(".showCreateMedal .fa-circle-plus");
const iconClose = document.querySelector(".showCreateMedal .fa-circle-xmark");
const formCreateMedal = document.querySelector(
    ".Main__Content--CreateMedal form"
);
formCreateMedal.style.display = "none";
showCreateMedal.addEventListener("click", function() {
    if (formCreateMedal.style.display == "none") {
        formCreateMedal.style.display = "block";
        iconClose.style.display = "block";
        iconShow.style.display = "none";
    } else {
        formCreateMedal.style.display = "none";
        iconClose.style.display = "none";
        iconShow.style.display = "block";
    }
});

//Kiểm tra ngày tạo
// Lấy ngày hiện tại
var currentDate = new Date();

// Lấy thẻ input ngày
var dateInput = document.querySelector("#DateCreatedMedal");

// Đặt giá trị tối thiểu cho input ngày là ngày hiện tại
dateInput.min = currentDate.toLocaleDateString("vi-VN");

// Xử lý sự kiện khi người dùng thay đổi giá trị input ngày
dateInput.addEventListener("change", function() {
    var selectedDate = new Date(dateInput.value);

    // Kiểm tra nếu ngày đã chọn nhỏ hơn hoặc bằng ngày hiện tại, đặt giá trị về ngày hiện tại
    if (selectedDate <= currentDate) {
        dateInput.value = currentDate.toLocaleDateString("vi-VN");
    }
});

// Lấy tất cả các thẻ input có thuộc tính "type" là "date"
var dateInputs = document.querySelectorAll("#DateCreatedMedals");

// Lặp qua từng thẻ input
for (var i = 0; i < dateInputs.length; i++) {
    var input = dateInputs[i];
    var inputValue = input.value;

    // Tạo đối tượng ngày từ giá trị của thẻ input
    var selectedDate = new Date(inputValue);

    // Lấy ngày hiện tại
    // var currentDate = new Date();

    // So sánh ngày đã chọn với ngày hiện tại
    if (selectedDate <= currentDate) {
        // Nếu ngày đã chọn lớn hơn hoặc bằng ngày hiện tại, khóa thẻ input
        input.style.pointerEvents = "none";
        // input.value = currentDate.toLocaleDateString("vi-VN");
    }
}
dateInputs.forEach(function(dateInput) {
    dateInput.addEventListener("change", function() {
        var selectedDate = new Date(dateInput.value);
        var currentDate = new Date(); // Lấy ngày hiện tại

        // Kiểm tra nếu ngày đã chọn nhỏ hơn hoặc bằng ngày hiện tại, đặt giá trị về ngày hiện tại
        if (selectedDate <= currentDate) {
            dateInput.value = currentDate.toLocaleDateString("vi-VN");
        }
    });
});

//Chọn năm

var yearSelect = document.getElementById("yearSelect");
var currentYear = new Date().getFullYear();
var endYear = currentYear + 10;

for (var year = currentYear; year <= endYear; year++) {
    var option = document.createElement("option");
    option.value = year;
    option.textContent = year;
    yearSelect.appendChild(option);

    if (year == endYear) {
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
    }
}
// Xử lí select
var myVariable = yearSelect.value;
var schoolYear = document.querySelector("#schoolYear input");

setInterval(function() {
    // Lấy giá trị mới từ phần tử <select>
    var newVariable = yearSelect.value;
    schoolYear.value = newVariable + " - " + (parseInt(newVariable) + 1);

    // Kiểm tra giá trị mới của biến
    if (myVariable !== newVariable) {
        console.log(newVariable);
        myVariable = newVariable; // Cập nhật giá trị của myVariable
        // document.getElementById("RegistrationSubmit").submit();
        schoolYear.value = newVariable + " - " + (parseInt(newVariable) + 1);
    }
}, 100);

//Quantity Input
var QtyInput = (function() {
    var qtyInputs = document.querySelectorAll(".quantityInput");

    if (!qtyInputs.length) {
        return;
    }

    var inputs = document.querySelectorAll(".product-qty");
    var countBtns = document.querySelectorAll(".qty-count");
    var qtyMin = parseInt(inputs[0].getAttribute("min"));
    var qtyMax = parseInt(inputs[0].getAttribute("max"));

    Array.from(inputs).forEach(function(input) {
        input.addEventListener("change", function() {
            var thisInput = this;
            var minusBtn = thisInput.nextElementSibling.previousElementSibling;
            var addBtn = thisInput.nextElementSibling;
            var qty = parseInt(thisInput.value);

            if (isNaN(qty) || qty <= qtyMin) {
                thisInput.value = qtyMin;
                minusBtn.disabled = true;
            } else {
                minusBtn.disabled = false;

                if (qty >= qtyMax) {
                    thisInput.value = qtyMax;
                    addBtn.disabled = true;
                } else {
                    thisInput.value = qty;
                    addBtn.disabled = false;
                }
            }
        });
    });

    Array.from(countBtns).forEach(function(btn) {
        btn.addEventListener("click", function() {
            var operator = this.dataset.action;
            var thisBtn = this;
            var parent = thisBtn.parentNode;
            var input = parent.querySelector(".product-qty");
            var qty = parseInt(input.value);

            if (operator === "add") {
                qty += 1;
                if (qty >= qtyMin + 1) {
                    parent.querySelector(".qty-count--minus").disabled = false;
                }

                if (qty >= qtyMax) {
                    thisBtn.disabled = true;
                }
            } else if (operator === "minus") {
                qty = qty <= qtyMin ? qtyMin : (qty -= 1);

                if (qty === qtyMin) {
                    thisBtn.disabled = true;
                }

                if (qty < qtyMax) {
                    parent.querySelector(".qty-count--add").disabled = false;
                }
            }

            input.value = qty;
            parent.querySelector(".qty-count--minus").disabled = qty === qtyMin;
        });
    });
})();
//Xóa

// Lấy tất cả các thẻ <a> có class "btnDelete"
var btnDelete = document.querySelectorAll("#btnDelete");

// Lặp qua từng thẻ <a> và gắn sự kiện click
btnDelete.forEach(function(element) {
    element.addEventListener("click", function() {
        // Lấy phần tử cha chung của thẻ <a> và popup
        var parent = this.parentElement;
        var popupConfirmSubmit = parent.querySelector(".popupConfirmSubmit");

        // Hiển thị popup
        popupConfirmSubmit.style.display = "block";
    });
});

var closePopupBtns = document.querySelectorAll("#close-popupConfirmSubmit");

// Gắn sự kiện click cho từng nút đóng popup
closePopupBtns.forEach(function(closeBtn) {
    closeBtn.addEventListener("click", function() {
        // Lấy phần tử cha của nút đóng popup
        var parent = this.parentElement.parentElement.parentElement;

        // Đóng popup
        parent.style.display = "none";
    });
});