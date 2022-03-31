function submit() {
  if (
    document.getElementById("new_password").value !==
    document.getElementById("check_password").value
  ) {
    alert("Passwords do not match!");
  } else if (document.getElementById("new_password").value.length > 7) {
    $.ajax({
      type: "POST",
      url: "/cms/changepassword",
      data: {
        old: document.getElementById("current_password").value,
        new: document.getElementById("new_password").value,
      },
    }).done(function (res) {
      if (res) {
        alert("Password changed!");
        document.getElementById("current_password").value = "";
        document.getElementById("new_password").value = "";
        document.getElementById("check_password").value = "";
      } else {
        alert("Password incorrect");
        document.getElementById("current_password").value = "";
      }
    });
  } else {
    alert("Password has to be at least 8 characters long.");
  }
}
document.getElementById("new_password").addEventListener("change", checkInputs);
document
  .getElementById("check_password")
  .addEventListener("change", checkInputs);

function checkInputs() {
  checkFirstInput();
  checkSecondInput();
}

function checkFirstInput() {
  if (document.getElementById("new_password").value.length < 8) {
    document.getElementById("newError").innerHTML = "Minimum of 8 characters.";
  } else {
    document.getElementById("newError").innerHTML = "";
  }
}

function checkSecondInput() {
  if (
    document.getElementById("check_password").value !==
    document.getElementById("new_password").value
  ) {
    document.getElementById("checkError").innerHTML = "Passwords do not match.";
  } else {
    document.getElementById("checkError").innerHTML = "";
  }
}
