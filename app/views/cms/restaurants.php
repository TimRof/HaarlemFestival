<?php
$pageTitle = "CMS - Restaurants";
include_once __DIR__ . '/../cmsnav.php';
?>
<div id="pagecontent">
    <h3>CMS - Restaurants</h3>

    <div class="backTitle">
        <a class="btn btn-outline-dark" href="/cms/addevent?type=food">Back</a>
        <h3 id="tableTitle">Overview</h3>
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
        <label for="name">Restaurant name: </label>
        <input class="form-control" type="text" name="name" id="name" placeholder="Name">
        <label for="description">Restaurant description: </label>
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
            <button class="btn btn-primary optionsbutton mt-2" onclick="updateUser()">Edit user</button>
            <button class="btn btn-danger optionsbutton mt-2" onclick="deleteUser()">Delete user</button>
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
    var add = true;

    document.onload = getRestaurants(0);

    function getRestaurants(index) {
        $.ajax({
            type: 'GET',
            url: '/events/getLimitedRestaurants',
            data: {
                limit: index
            }
        }).done(function(res) {
            // get total amount of items
            let key = "count";
            elementsTotal = res[0].count;
            res.forEach(element => {
                delete element[key];
            });
            makeTable(res);
            calculatePages();
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
        } else {
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
        getRestaurants(currentPage * elementsShown); // variable is index of elements
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
        // document.getElementById('pageNav').insertBefore(backBut, document.getElementById('pageNav').firstChild);
    }

    function backButtonPressed() {
        currentPage--;
        getRestaurants(currentPage * elementsShown); // variable is index of elements
    }

    function makeTable(res) {
        // reset boxes
        clearInfo();
        let table = document.getElementById("table-body");
        $("#table-body tr").remove();
        res.forEach(element => {
            let i = 0;
            let row = table.insertRow();
            for (let k in element) {
                let cell = row.insertCell(i);
                cell.id = element.id;
                if (element[k].length > 90) { // max length
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
                getRestaurant(selected);
            }
        }
    })

    function getRestaurant(id) {
        $.ajax({
            type: 'GET',
            url: '/events/getRestaurant',
            data: {
                id: id
            }
        }).done(function(res) {
            fillInfo(res);
        })
    }

    function fillInfo(res) {
        console.log(res);
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
</script>