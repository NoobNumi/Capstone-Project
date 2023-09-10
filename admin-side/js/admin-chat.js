$(document).ready(function () {
  const form = document.querySelector(".typing-area");
  const inputField = form.querySelector(".input-field");
  const sendBtn = form.querySelector("button");
  const chatBox = document.querySelector(".chat-box");
  const confirmButton = document.getElementById('btn_confirm');

  const urlParams = new URLSearchParams(window.location.search);
  const user_id = urlParams.get('user_id');

  if (!user_id) {
    console.error("user_id not found in URL.");
    return;
  }

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
    console.log('Send button clicked');
    sendMessage();
  };

  function sendMessage() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "admin_handle_messages.php", true);
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
    formData.append("user_id", user_id);
    xhr.send(formData);
  }

  function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
  }

  function updateChat() {
    console.log('Updating chat...');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "admin_handle_messages.php", true);
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
    xhr.send("action=get&user_id=" + user_id);
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
          window.location.href = "admin_login.php";
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

});
