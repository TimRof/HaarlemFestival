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
    <div id="pageNav"></div>
    <hr>
    <div style="margin: auto;width: 30%;">
        <h5 id="updateTitle">Update (none selected)</h5>
        <label for="first_name">First name: </label>
        <input class="form-control" type="text" name="first_name" id="first_name" placeholder="First Name">
        <label for="last_name">Last name: </label>
        <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Last Name">
        <label for="email">Email: </label>
        <input class="form-control" type="email" name="email" id="email" placeholder="Email">
        <label for="role_types">User Role: </label>
        <select class="form-select" name="role_types" id="role_types">
        </select>
        <div style="text-align: center;">
            <button class="btn btn-primary mt-2" onclick="updateUser()">Edit user</button>
            <button class="btn btn-danger mt-2" onclick="deleteUser()">Delete user</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    var selected;
    var previousItems = 0;
    var elementsTotal = 0;
    var elementsIndex = -5;
    var elementsShown = 0;
    var elementsMax = 5;
    var elementsOnPage = 0;
    var pagesLeft = 0;
    var add;

    document.onload = nextButtonPressed();

    function getRestaurants() {
        $.ajax({
            type: 'GET',
            url: '/events/getLimitedRestaurants',
            data: {
                limit: elementsIndex
            }
        }).done(function(res) {
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
        if (add) {
            elementsShown += elementsOnPage;
        } else {
            elementsShown -= previousItems;
        }
        let elementsLeft = elementsTotal - elementsShown;
        // console.log(add);
        // console.log("Total items: " + elementsTotal);
        // console.log("Items index: " + elementsIndex);
        // console.log("Items shown: " + elementsShown);
        // console.log("Items left: " + elementsLeft);
        // console.log("Previous: " + previousItems);
        // console.log("Page: " + elementsOnPage);
        pagesLeft = 0;
        while (elementsLeft > 0) {
            pagesLeft++;
            elementsLeft -= elementsMax;
        }
        // console.log("Pages left: " + pagesLeft);
        pageButtons();
        previousItems = elementsOnPage;
    }

    function pageButtons() {
        if ($('#next').length > 0) {
            next.remove();
        }
        if ($('#back').length > 0) {
            back.remove();
        }
        if (elementsIndex > 0) {
            // console.log("Back button");
            backButton();
        }
        if (pagesLeft > 0) {
            // console.log("Next button");
            nextButton();
        }
    }

    function nextButton() {
        let nextBut = document.createElement('button');
        nextBut.innerHTML = "Next";
        nextBut.id = "next";
        nextBut.classList.add("btn");
        nextBut.classList.add("btn-primary");
        nextBut.classList.add("optionsbutton");
        nextBut.onclick = function() {
            nextButtonPressed();
        };
        document.getElementById('pageNav').appendChild(nextBut);
    }

    function nextButtonPressed() {
        add = true;
        elementsIndex += 5;
        getRestaurants();
    }

    function backButton() {
        let backBut = document.createElement('button');
        backBut.innerHTML = "Back";
        backBut.id = "back";
        backBut.classList.add("btn");
        backBut.classList.add("btn-primary");
        backBut.classList.add("optionsbutton");
        backBut.onclick = function() {
            backButtonPressed();
        };
        document.getElementById('pageNav').appendChild(backBut);
    }

    function backButtonPressed() {
        add = false;
        elementsIndex -= 5;
        getRestaurants();
    }

    function makeTable(res) {
        let table = document.getElementById("table-body");
        $("#table-body tr").remove();
        elementsOnPage = 0;
        res.forEach(element => {
            elementsOnPage++;
            let i = 0;
            let row = table.insertRow();
            for (let k in element) {
                let cell = row.insertCell(i);
                cell.id = element.id;
                if (element[k].length > 90) {
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
            console.log(res);
        })
    }

    function fillInfo(res) {
        document.getElementById("first_name").value = res.first_name;
        document.getElementById("last_name").value = res.last_name;
        document.getElementById("email").value = res.email;
        document.getElementById("role_types").value = res.role_id;
        updateTitle.innerHTML = "Updating user";
    }

    function clearInfo() {
        document.getElementById("first_name").value = null;
        document.getElementById("last_name").value = null;
        document.getElementById("email").value = null;
        document.getElementById("role_types").value = null;
        updateTitle.innerHTML = "Update (none selected)";
        selected = null;
    }
</script>