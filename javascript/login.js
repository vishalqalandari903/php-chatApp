const form = document.querySelector(".login form"),
  continueBtn = document.querySelector(".button input"),
  errorText = document.querySelector(".error-txt");

form.addEventListener("submit", function (e) {
  e.preventDefault();
});

continueBtn.addEventListener("click", function () {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/login.php", true);
  xhr.addEventListener("load", () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        // console.log(data);
        if (data == "success") {
          location.href = "users.php";
        } else {
          errorText.textContent = data;
          errorText.style.display = "block";
        }
      }
    }
  });

  let formData = new FormData(form);
  xhr.send(formData);
});
