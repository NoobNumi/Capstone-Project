const form = document.querySelector(".typing-area");
const inputField = form.querySelector(".input-field");
const sendBtn = form.querySelector("button");
const chatBox = document.querySelector(".chat-box");
const confirmButton = document.getElementById('btn_confirm');

form.onsubmit = (e) => {
  e.preventDefault();
};

inputField.focus();
inputField.onkeyup = () => {
  if (inputField.value !== "") {
    sendBtn.classList.add("active");
  } else {
    sendBtn.classList.remove("active");
  }
};

sendBtn.onclick = () => {
  sendMessage();
};

function sendMessage() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "handle_messages.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = "";
        updateChat();
      } else {
        console.error("Failed to send message:", xhr.status);
      }
    }
  };
  let formData = new FormData(form);
  formData.append("action", "insert");
  xhr.send(formData);
}

function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}

function updateChat() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "handle_messages.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        scrollToBottom();
      } else {
        console.error("Failed to fetch messages:", xhr.status);
      }
    }
  };

  xhr.onerror = function () {
    console.error('An error occurred with the AJAX request.');
  };

  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("action=get");
}

confirmButton.addEventListener('click', () => {
  logoutUser(); 
});

function logoutUser() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "logout.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        window.location.href = "login.php";
      } else {
        console.error("Failed to log out:", xhr.status);
      }
    }
  };
  xhr.send();
}

updateChat();

setInterval(updateChat, 500);

window.onload = function () {
  scrollToBottom();
  updateChat();
};
