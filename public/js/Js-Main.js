//Message
// const mainElement = document.querySelector(".MainMessage");

function MessageSuccess(Title, Message) {
    const messageElement = document.createElement("div");
    messageElement.classList.add("messageSuccess");
    messageElement.style.animation =
        " slideInLeft ease 0.4s,  fadeOut linear 1s 4s forwards";
    messageElement.innerHTML = `
      <div class="messageSuccess__icon">
      <i class="fa-solid fa-circle-check fa-shake"></i>
      </div>
      <div class="messageSuccess__content">
        <p class="messageSuccess__content--title">
          ${Title}
        </p>
        <p class="messageSuccess__content--note">
        ${Message}
        </p>
      </div>
      <div class="messageSuccess__close">
        <i class="fas fa-times"></i>
      </div>`;

    document.querySelector(".MainMessage").append(messageElement);
    const closeElement = document.querySelectorAll(".messageSuccess__close");

    const autoRemove = setTimeout(() => {
        // document.querySelector(".MainMessage").removeChild(document.querySelector(".MainMessage").childNodes[0]);
        document.querySelector(".MainMessage").childNodes[0].remove();
    }, 4000 + 1000);

    messageElement.onclick = function(e) {
        if (e.target.closest(".messageSuccess__close")) {
            document.querySelector(".MainMessage").removeChild(messageElement);
            // document.querySelector(".MainMessage").childNodes[0].remove();
            clearTimeout(autoRemove);
        }
    };
}

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
// Khi trang web đã tải xong, ẩn màn hình loading
window.addEventListener("load", function() {
    var loadingOverlay = document.getElementById("loading-overlay");
    loadingOverlay.style.display = "none";
});