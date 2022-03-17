<?php
$pageTitle = "CMS - Venues";
include_once __DIR__ . '/../cmsnav.php';
?>
<div id="pagecontent">
    <h3>CMS - Venues</h3>

    <div class="backTitle">
        <a class="btn btn-outline-dark" href="/cms/addevent?type=jazz">Back</a>
        <h3 id="tableTitle">Overview</h3>
    </div>
    <div>
        <button type="button" class="btn btn-outline-danger" id="clearbutton" hidden>Clear search</button>
        <div class="input-group" style="width: 30%; float:right">
            <input type="search" class="form-control rounded" placeholder="Search" id="searchbox" />
            <button type="button" class="btn btn-outline-primary" id="searchbutton">search</button>
        </div>
    </div>
    <div>
        <table id="users" class="table table-striped">
            <thead class="thead-light">
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Country</th>
                <th>City</th>
                <th>Zipcode</th>
                <th>Address</th>
            </thead>
            <tbody id="table-body"></tbody>
        </table>
        <div id="pageNav">
            <div style="float:left" id="previousButton"></div>
            <div style="float:right" id="nextButton"></div>
        </div>
    </div>

    <hr style="clear: both">
    <div style="margin: auto;width: 30%;">
        <h5 id="updateTitle">Update (none selected)</h5>
        <label for="name">Location name: </label>
        <input class="form-control" type="text" name="name" id="name" placeholder="Name">
        <label for="description">Location description: </label>
        <textarea class="form-control" name="description" id="description" placeholder="Description" rows="7"></textarea>
        <label for="country">Country: </label>
        <input class="form-control" type="country" name="country" id="country" placeholder="Country">
        <label for="city">City: </label>
        <input class="form-control" type="city" name="city" id="city" placeholder="City">
        <label for="zipcode">Zipcode: </label>
        <input class="form-control" type="zipcode" name="zipcode" id="zipcode" placeholder="Zipcode">
        <label for="address">Address: </label>
        <input class="form-control" type="address" name="address" id="address" placeholder="Address">
        <div style="text-align: center;">
            <button class="btn btn-primary optionsbutton mt-2" onclick="updateVenue()">Make changes</button>
            <button class="btn btn-danger optionsbutton mt-2" onclick="deleteVenue()">Delete</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    var selected;
    var elementsTotal = 0;
    var currentPage = 0;
    var elementsShown = 5;
    var totalPages = 0;
    var query = "";

    document.onload = searchVenues(0);

    var search = document.getElementById('searchbutton')
    search.addEventListener("click", function() {
        query = document.getElementById('searchbox').value;
        if (query == "") {
            document.getElementById('clearbutton').hidden = true;
        } else {
            document.getElementById('clearbutton').hidden = false;
        }
        searchVenues(0);
        currentPage = 0;
    });
    document.getElementById('clearbutton').addEventListener("click", function() {
        document.getElementById('searchbox').value = "";
        query = "";
        document.getElementById('clearbutton').hidden = true;
        searchVenues(0);
    });

    function searchVenues(index) {
        $.ajax({
            type: 'GET',
            url: '/events/searchVenues',
            data: {
                limit: index,
                query: query
            }
        }).done(function(res) {
            if (res.length === 0) {
                alert("Nothing found!");
            } else {
                // get total amount of items
                let key = "count";
                elementsTotal = res[0].count;
                res.forEach(element => {
                    delete element[key];
                });
                makeTable(res);
                calculatePages();
            }
        })
    }

    function calculatePages() {
        // total amount of pages (rounded up)
        totalPages = Math.ceil(elementsTotal / elementsShown);
        pageButtons();
    }

    function pageButtons() {
        // create next and back buttons
        if (currentPage < totalPages - 1) {
            if (!($('#next').length > 0)) {
                nextButton();
            }
        } else if ($('#next').length > 0) {
            next.remove();
        }
        if (currentPage > 0) {
            if (!($('#back').length > 0)) {
                backButton();
            }
        } else if ($('#back').length > 0) {
            back.remove();
        }
    }

    function nextButton() {
        let nextBut = document.createElement('button');
        nextBut.innerHTML = "Next page";
        nextBut.id = "next";
        nextBut.classList.add("btn");
        nextBut.classList.add("btn-primary");
        nextBut.classList.add("optionsbutton");
        nextBut.onclick = function() {
            nextButtonPressed();
        };
        document.getElementById('nextButton').appendChild(nextBut);
    }

    function nextButtonPressed() {
        currentPage++;
        searchVenues(currentPage * elementsShown); // variable is index of elements
    }

    function backButton() {
        let backBut = document.createElement('button');
        backBut.innerHTML = "Previous page";
        backBut.id = "back";
        backBut.classList.add("btn");
        backBut.classList.add("btn-primary");
        backBut.classList.add("optionsbutton");
        backBut.onclick = function() {
            backButtonPressed();
        };
        document.getElementById('previousButton').appendChild(backBut);
    }

    function backButtonPressed() {
        currentPage--;
        searchVenues(currentPage * elementsShown); // variable is index of elements
    }

    function makeTable(res) {
        clearInfo(); // reset boxes
        let table = document.getElementById("table-body");
        $("#table-body tr").remove();
        res.forEach(element => {
            let i = 0;
            let row = table.insertRow();
            for (let k in element) {
                let cell = row.insertCell(i);
                cell.id = element.id;
                if (element[k].length > 90) { // max length of text
                    cell.innerHTML = element[k].slice(0, 90) + ' ...';
                } else {
                    cell.innerHTML = element[k];
                }
                i++;
            }
        });
    }
    // click event for table fill
    document.addEventListener('click', function(e) {
        if (e.target.tagName.toLowerCase() === "td") {
            if (e.target.id === selected) {
                clearInfo();
            } else {
                selected = e.target.id;
                getVenue(selected);
            }
        }
    })

    function getVenue(id) {
        $.ajax({
            type: 'GET',
            url: '/events/getVenue',
            data: {
                id: id
            }
        }).done(function(res) {
            fillInfo(res);
        })
    }

    function updateVenue() {
        let name = document.getElementById("name").value
        let description = document.getElementById("description").value
        let country = document.getElementById("country").value
        let city = document.getElementById("city").value
        let zipcode = document.getElementById("zipcode").value
        let address = document.getElementById("address").value

        $.ajax({
            type: 'POST',
            url: '/events/updateVenue',
            data: {
                id: selected,
                name: name,
                description: description,
                country: country,
                city: city,
                zipcode: zipcode,
                address: address
            }
        }).done(function(res) {
            alert(res);
            searchVenues(currentPage * elementsShown);
        })
    }

    function deleteVenue() {
        var text = "Are you sure you want to delete this venue?\nThis can not be undone!";
        if (confirm(text) == false) {
            return;
        }
        $.ajax({
            type: 'POST',
            url: '/events/deleteVenue',
            data: {
                id: selected
            }
        }).done(function(res) {
            alert(res);
            searchVenues(currentPage * elementsShown);
        })
    }

    function fillInfo(res) {
        document.getElementById("name").value = res.name;
        document.getElementById("description").value = res.description;
        document.getElementById("country").value = res.country;
        document.getElementById("city").value = res.city;
        document.getElementById("zipcode").value = res.zipcode;
        document.getElementById("address").value = res.address;
        updateTitle.innerHTML = "Updating venue";
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
</script>