const passwordField = document.querySelector(".form .field .password-field");
const toggleBtn = document.querySelector(".form .field i");

toggleBtn.addEventListener("click", () => {
  if (passwordField.type == "password") {
    passwordField.type = "text";
    toggleBtn.classList.add("fa-eye-slash");
    toggleBtn.classList.remove("fa-eye");
  } else {
    passwordField.type = "password";
    toggleBtn.classList.remove("fa-eye-slash");
    toggleBtn.classList.add("fa-eye");
  }
});
