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
openDropdown.addEventListener("click", function() {
    DropdownAccount.style.display = "none";
});
document.addEventListener("click", function(e) {
    var isClickInsideMyDiv = closeDropdown.contains(e.target);

    // Nếu không phải, thì đó là sự kiện click ra vùng bên ngoài
    if (!isClickInsideMyDiv) {
        // Ẩn thẻ div
        DropdownAccount.style.display = "none";
        openDropdown.classList.add("hidden");
        closeDropdown.classList.remove("hidden");
    }
});

closeDropdown.addEventListener("click", function() {
    DropdownAccount.style.display = "block";
});

closeDropdown.addEventListener("click", function() {
    openDropdown.classList.remove("hidden");
    closeDropdown.classList.add("hidden");
    openDropdown.style.color = "rgba(29, 171, 161, 1)";
});
openDropdown.addEventListener("click", function() {
    openDropdown.classList.add("hidden");
    closeDropdown.classList.remove("hidden");
});

//Dropdown Notification
openNotification.addEventListener("click", function() {
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
document.addEventListener("click", function(e) {
    var isClickInsideMyDiv = openNotification.contains(e.target);

    // Nếu không phải, thì đó là sự kiện click ra vùng bên ngoài
    if (!isClickInsideMyDiv) {
        // Ẩn thẻ div
        DropdownNotification.style.display = "none";
        openNotification.style.color = "rgb(255, 255, 255)";
    }
});