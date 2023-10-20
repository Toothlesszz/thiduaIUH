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
const formRegistration = document.querySelector("#form-registration");

// Gắn sự kiện "submit" cho form
formRegistration.addEventListener("submit", function(event) {
    event.preventDefault(); // Ngăn sự kiện submit mặc định

    validateIDCandidate();
});

function validateIDCandidate() {
    const idCandidateRegex = /^[0-9]{8}$/; // Biểu thức chính quy kiểm tra chuỗi gồm 8 chữ số

    if (idCandidateRegex.test(IDCandidate.value)) {
        // alert("Chuỗi hợp lệ");
        formRegistration.submit();
    } else {
        // alert("Chuỗi không hợp lệ");
        MessageImgError(
            "ĐĂNG KÝ KHÔNG THÀNH CÔNG!",
            "Mã ứng viên phải là dãy số gồm 8 chữ số!"
        );
    }
}