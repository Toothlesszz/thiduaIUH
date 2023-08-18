const inputElementTime = document.querySelector("#Time");
const inputElementDate = document.querySelector("#Date");
const closeDropdown = document.querySelector("#openDropdown-Account");
const openDropdown = document.querySelector("#closeDropdown-Account");
const DropdownAccount = document.querySelector(".nav");

const openNotification = document.querySelector("#openNotification");
const DropdownNotification = document.querySelector(".Notification__content");

//Date Time
const date = new Date();
const options = {
  month: "long",
  day: "numeric",
};
const formattedDate = date.toLocaleDateString("en-US", options);
inputElementDate.innerHTML = formattedDate;

// Time
function showClock() {
  // Lấy giá trị thời gian hiện tại
  const now = new Date();
  const hours = now.getHours();
  const minutes = now.getMinutes();
  // Định dạng thời gian hiện tại
  const time = `${hours < 10 ? "0" + hours : hours}:${
    minutes < 10 ? "0" + minutes : minutes
  }`;
  // Hiển thị thời gian trên trang web
  inputElementTime.innerHTML = time;
}
// Cập nhật giá trị thời gian mỗi giây
setInterval(showClock, 1);

//Dropdown Account
openDropdown.addEventListener("click", function () {
  DropdownAccount.style.display = "none";
});
document.addEventListener("click", function (e) {
  var isClickInsideMyDiv = closeDropdown.contains(e.target);

  // Nếu không phải, thì đó là sự kiện click ra vùng bên ngoài
  if (!isClickInsideMyDiv) {
    // Ẩn thẻ div
    DropdownAccount.style.display = "none";
    openDropdown.classList.add("hidden");
    closeDropdown.classList.remove("hidden");
  }
});

closeDropdown.addEventListener("click", function () {
  DropdownAccount.style.display = "block";
});

closeDropdown.addEventListener("click", function () {
  openDropdown.classList.remove("hidden");
  closeDropdown.classList.add("hidden");
  openDropdown.style.color = "rgba(29, 171, 161, 1)";
});
openDropdown.addEventListener("click", function () {
  openDropdown.classList.add("hidden");
  closeDropdown.classList.remove("hidden");
});

//Dropdown Notification
openNotification.addEventListener("click", function () {
  if (
    window.getComputedStyle(DropdownNotification).getPropertyValue("display") ==
    "none"
  ) {
    DropdownNotification.style.display = "block";
    openNotification.style.color = "rgba(29, 171, 161, 1)";
  } else {
    DropdownNotification.style.display = "none";
    openNotification.style.color = "rgb(255, 255, 255)";
  }
});
document.addEventListener("click", function (e) {
  var isClickInsideMyDiv = openNotification.contains(e.target);

  // Nếu không phải, thì đó là sự kiện click ra vùng bên ngoài
  if (!isClickInsideMyDiv) {
    // Ẩn thẻ div
    DropdownNotification.style.display = "none";
    openNotification.style.color = "rgb(255, 255, 255)";
  }
});

//Select Custom
var selects = document.querySelectorAll("select");
// var selectsIcon = document.querySelectorAll("#selectIcon");

selects.forEach(function (select) {
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

  selectStyled.addEventListener("click", function (e) {
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
    listItem.addEventListener("click", function (e) {
      e.stopPropagation();
      selectStyled.textContent = this.textContent;
      selectStyled.classList.remove("active");
      select.value = this.getAttribute("rel");
      // selectsIcon.classList.add("fa-rotate-90");
      // selectsIcon.classList.remove("fa-rotate-270");
      list.style.display = "none";
    });
  }

  document.addEventListener("click", function () {
    selectStyled.classList.remove("active");
    // selectsIcon.classList.add("fa-rotate-90");
    // selectsIcon.classList.remove("fa-rotate-270");
    list.style.display = "none";
  });
});
