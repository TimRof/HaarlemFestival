let isRecaptchaValidated = false;

function onRecaptchaSuccess() {
  isRecaptchaValidated = true;
}

function onRecaptchaError() {
  document.getElementById("captchaError").hidden = false;
}

function onRecaptchaResponseExpiry() {
  onRecaptchaError();
}

window.onload = function () {
  const recaptchaForm = document.getElementById("formLogin");
  recaptchaForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // remove credentials error if present
    if (document.getElementById("loginError")) {
      document.getElementById("loginError").hidden = true;
    }

    // failure
    if (!isRecaptchaValidated) {
      onRecaptchaError();
      return;
    }

    // success
    document.getElementById("captchaError").hidden = true;
    recaptchaForm.submit();
  });
};
