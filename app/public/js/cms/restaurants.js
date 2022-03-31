var selected;
var elementsTotal = 0;
var currentPage = 0;
var elementsShown = 5;
var totalPages = 0;
var query = "";

document.onload = searchRestaurants(0);

var search = document.getElementById("searchbutton");
search.addEventListener("click", function () {
  query = document.getElementById("searchbox").value;
  if (query == "") {
    document.getElementById("clearbutton").hidden = true;
  } else {
    document.getElementById("clearbutton").hidden = false;
  }
  searchRestaurants(0);
  currentPage = 0;
});
document.getElementById("clearbutton").addEventListener("click", function () {
  document.getElementById("searchbox").value = "";
  query = "";
  document.getElementById("clearbutton").hidden = true;
  searchRestaurants(0);
});

function searchRestaurants(index) {
  $.ajax({
    type: "GET",
    url: "/events/searchRestaurants",
    data: {
      limit: index,
      query: query,
    },
  }).done(function (res) {
    if (res.length === 0) {
      alert("Nothing found!");
    } else {
      // get total amount of items
      let key = "count";
      elementsTotal = res[0].count;
      res.forEach((element) => {
        delete element[key];
      });
      makeTable(res);
      calculatePages();
    }
  });
}

function calculatePages() {
  // total amount of pages (rounded up)
  totalPages = Math.ceil(elementsTotal / elementsShown);
  pageButtons();
}

function pageButtons() {
  // create next and back buttons
  if (currentPage < totalPages - 1) {
    if (!($("#next").length > 0)) {
      nextButton();
    }
  } else if ($("#next").length > 0) {
    next.remove();
  }
  if (currentPage > 0) {
    if (!($("#back").length > 0)) {
      backButton();
    }
  } else if ($("#back").length > 0) {
    back.remove();
  }
}

function nextButton() {
  let nextBut = document.createElement("button");
  nextBut.innerHTML = "Next page";
  nextBut.id = "next";
  nextBut.classList.add("btn");
  nextBut.classList.add("btn-primary");
  nextBut.classList.add("optionsbutton");
  nextBut.onclick = function () {
    nextButtonPressed();
  };
  document.getElementById("nextButton").appendChild(nextBut);
}

function nextButtonPressed() {
  currentPage++;
  searchRestaurants(currentPage * elementsShown); // variable is index of elements
}

function backButton() {
  let backBut = document.createElement("button");
  backBut.innerHTML = "Previous page";
  backBut.id = "back";
  backBut.classList.add("btn");
  backBut.classList.add("btn-primary");
  backBut.classList.add("optionsbutton");
  backBut.onclick = function () {
    backButtonPressed();
  };
  document.getElementById("previousButton").appendChild(backBut);
}

function backButtonPressed() {
  currentPage--;
  searchRestaurants(currentPage * elementsShown); // variable is index of elements
}

function makeTable(res) {
  clearInfo(); // reset boxes
  let table = document.getElementById("table-body");
  $("#table-body tr").remove();
  res.forEach((element) => {
    let i = 0;
    let row = table.insertRow();
    for (let k in element) {
      let cell = row.insertCell(i);
      cell.id = element.id;
      if (element[k].length > 90) {
        // max length of text
        cell.innerHTML = element[k].slice(0, 90) + " ...";
      } else {
        cell.innerHTML = element[k];
      }
      i++;
    }
  });
}
// click event for table fill
document.addEventListener("click", function (e) {
  if (e.target.tagName.toLowerCase() === "td") {
    if (e.target.id === selected) {
      clearInfo();
    } else {
      selected = e.target.id;
      getRestaurant(selected);
    }
  }
});

function getRestaurant(id) {
  $.ajax({
    type: "GET",
    url: "/events/getRestaurant",
    data: {
      id: id,
    },
  }).done(function (res) {
    fillInfo(res);
  });
}

function updateRestaurant() {
  let name = document.getElementById("name").value;
  let description = document.getElementById("description").value;
  let country = document.getElementById("country").value;
  let city = document.getElementById("city").value;
  let zipcode = document.getElementById("zipcode").value;
  let address = document.getElementById("address").value;

  $.ajax({
    type: "POST",
    url: "/events/updateRestaurant",
    data: {
      id: selected,
      name: name,
      description: description,
      country: country,
      city: city,
      zipcode: zipcode,
      address: address,
    },
  }).done(function (res) {
    alert(res);
    searchRestaurants(currentPage * elementsShown);
  });
}

function deleteRestaurant() {
  var text =
    "Are you sure you want to delete this restaurant?\nThis can not be undone!";
  if (confirm(text) == false) {
    return;
  }
  $.ajax({
    type: "POST",
    url: "/events/deleteRestaurant",
    data: {
      id: selected,
    },
  }).done(function (res) {
    alert(res);
    searchRestaurants(currentPage * elementsShown);
  });
}

function fillInfo(res) {
  document.getElementById("name").value = res.name;
  document.getElementById("description").value = res.description;
  document.getElementById("country").value = res.country;
  document.getElementById("city").value = res.city;
  document.getElementById("zipcode").value = res.zipcode;
  document.getElementById("address").value = res.address;
  updateTitle.innerHTML = "Updating restaurant";
}

function clearInfo() {
  document.getElementById("name").value = null;
  document.getElementById("description").value = null;
  document.getElementById("country").value = null;
  document.getElementById("city").value = null;
  document.getElementById("zipcode").value = null;
  document.getElementById("address").value = null;
  updateTitle.innerHTML = "Update (none selected)";
  selected = null;
}
