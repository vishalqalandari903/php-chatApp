const form = document.querySelector(".typing-area"),
  inputField = form.querySelector(".input-field"),
  sendBtn = form.querySelector("button"),
  chatBox = document.querySelector(".chat-box");

function typingStatus() {}

let ScrollChatToBottom = true;

form.addEventListener("submit", function (e) {
  e.preventDefault();
});

sendBtn.addEventListener("click", () => {
  console.log(inputField.value);
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/insert-talk.php", true);
  xhr.addEventListener("load", () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = "";
        inputField.focus();
        ScrollChatToBottom = true;
      }
    }
  });

  let formData = new FormData(form);
  xhr.send(formData);
  inputField.style.height = "40px";
});

function getChat() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/get-talk.php", true);
  xhr.addEventListener("load", () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (ScrollChatToBottom) {
          chatBox.scrollTop = chatBox.scrollHeight;
        }

        ScrollChatToBottom = false;
      }
    }
  });

  let formData = new FormData(form);
  xhr.send(formData);
}

function getUserStatus() {
  if (inputField.value.length > 0 && document.activeElement == inputField) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-user-status.php", true);
    xhr.addEventListener("load", () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          document.querySelector("#user-status").innerHTML = data;
        }
      }
    });

    let formData = new FormData(form);
    formData.append("status", "typing");
    xhr.send(formData);
  } else {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-user-status.php", true);
    xhr.addEventListener("load", () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          document.querySelector("#user-status").innerHTML = data;
        }
      }
    });

    let formData = new FormData(form);
    formData.append("status", "");

    xhr.send(formData);
  }
}

getChat();

setInterval(getChat, 500);
setInterval(getUserStatus, 500);
setInterval(typingStatus, 500);

window.addEventListener("beforeunload", function () {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/get-user-status.php", true);
  xhr.addEventListener("load", () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        document.querySelector("#user-status").innerHTML = data;
      }
    }
  });

  let formData = new FormData(form);
  formData.append("status", "");

  xhr.send(formData);
});

// Typing Area JS Code Starts Here
function countLines(textarea) {
  const lineCount = (textarea.value.match(/\n/g) || []).length + 1;
  return lineCount;
}
function autoExpand(textarea) {
  if (textarea.scrollHeight <= 170) {
    textarea.style.height = "0px";
    textarea.style.height = textarea.scrollHeight + "px";
  } else {
    textarea.style.height = "170px";
  }
  chatBox.scrollTop = chatBox.scrollHeight;
}

inputField.addEventListener("input", () => {
  let numberOfLines = countLines(inputField);
  autoExpand(inputField);
});

// Typing Area JS Code Ends Here
