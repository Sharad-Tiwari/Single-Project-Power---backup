const form = document.querySelector(".typing-area"),
  inputFeild = form.querySelector(".input-field"),
  sendBtn = form.querySelector("button"),
    chatBox = document.querySelector(".chat-box");
  


form.onsubmit = (e) => {
  e.preventDefault();
};

sendBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php1/insert-chat.php", true);
  xhr.getResponseHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputFeild.value = "";
        scrollToBottom();
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};

chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
}

chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
};

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php1/get-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) {
          scrollToBottom();
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
}, 500);


function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}