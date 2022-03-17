<?php
$pageTitle = "CMS - Users";
include_once __DIR__ . '/../cmsnav.php';
?>
<div id="pagecontent">
    <h3>CMS - Users</h3>

    <h3 id="tableTitle">Overview</h3>
    <table id="users" class="table table-striped">
        <thead class="thead-light">
            <th>Id</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created on</th>
            <th>Updated at</th>
        </thead>
        <tbody id="table-body"></tbody>
    </table>
    <div style="text-align:right"><a class="btn btn-primary" href="/cms/adduser">Add user</a></div>
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
            <button class="btn btn-primary optionsbutton mt-2" onclick="updateUser()">Make changes</button>
            <button class="btn btn-danger optionsbutton mt-2" onclick="deleteUser()">Delete</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    var selected = null;
    document.onload = getUsers();
    document.onload = getEventTypes();

    function getUsers() {
        $.ajax({
            type: 'GET',
            url: '/cms/getUsers',
        }).done(function(res) {
            makeTable(res);
        })
    }

    function getEventTypes() {
        $.ajax({
            type: 'GET',
            url: '/cms/getRoleTypes',
        }).done(function(res) {
            makeRoleTypes(res);
        })
    }

    function makeRoleTypes(res) {
        document.getElementById('role_types').innerHTML = "";
        var select = document.getElementById('role_types');

        for (const type of res) {
            var option = document.createElement('option');
            option.value = type.id;

            var description = document.createTextNode(type.name);
            option.appendChild(description);

            select.appendChild(option);
        }
        clearInfo();
    }

    function makeTable(res) {
        let table = document.getElementById("table-body");
        $("#table-body tr").remove();
        res.forEach(element => {
            let i = 0;
            let row = table.insertRow();
            for (var k in element) {
                let cell = row.insertCell(i);
                cell.id = element.id;
                if (k === "role_id") {
                    switch (element[k]) {
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
                getUser(selected);
            }
        }
    })

    function getUser(id) {
        $.ajax({
            type: 'GET',
            url: '/cms/findById',
            data: {
                id: id
            }
        }).done(function(res) {
            fillInfo(res);
        })
    }

    function updateUser() {
        first_name = document.getElementById("first_name").value;
        last_name = document.getElementById("last_name").value;
        email = document.getElementById("email").value;
        role_id = document.getElementById("role_types").value;

        $.ajax({
            type: 'POST',
            url: '/cms/updateUser',
            data: {
                id: selected,
                first_name: first_name,
                last_name: last_name,
                email: email,
                role_id: role_id
            }
        }).done(function(res) {
            getUsers();
            clearInfo();
            alert(res);
        })
    }

    function deleteUser() {
        var text = "Are you sure you want to delete this user?\nThis can not be undone!";
        if (confirm(text) == false) {
            return;
        }
        $.ajax({
            type: 'POST',
            url: '/cms/deleteUser',
            data: {
                id: selected
            }
        }).done(function(res) {
            getUsers();
            alert(res);
            clearInfo();
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