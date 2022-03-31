document.onload = getOwnInfo();

function getOwnInfo() {
  $.ajax({
    type: "GET",
    url: "/cms/getOwnInfo",
  }).done(function (res) {
    makeTable(res);
  });
}

function updateSelf() {
  first_name = document.getElementById("first_name").value;
  last_name = document.getElementById("last_name").value;
  email = document.getElementById("email").value;

  $.ajax({
    type: "POST",
    url: "/cms/updateSelf",
    data: {
      first_name: first_name,
      last_name: last_name,
      email: email,
    },
  }).done(function (res) {
    getOwnInfo();
    alert(res);
  });
}

function makeTable(res) {
  let table = document.getElementById("table-body");
  $("#table-body tr").remove();
  let i = 0;
  let row = table.insertRow();
  for (var k in res) {
    let cell = row.insertCell(i);
    cell.id = res.id;
    if (k === "role_id") {
      switch (res[k]) {
        case 1:
          cell.innerHTML = "User";
          break;
        case 2:
          cell.innerHTML = "Administrator";
          break;
        case 3:
          cell.innerHTML = "Super Administrator";
          break;
        default:
          cell.innerHTML = "Error in database";
          break;
      }
    } else {
      cell.innerHTML = res[k];
    }
    i++;
  }
  fillInfo(res);
}

function fillInfo(res) {
  document.getElementById("first_name").value = res.first_name;
  document.getElementById("last_name").value = res.last_name;
  document.getElementById("email").value = res.email;
}
