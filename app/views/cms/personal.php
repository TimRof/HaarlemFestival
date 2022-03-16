<?php
$pageTitle = "CMS - Personal";
include_once __DIR__ . '/../cmsnav.php';
?>
<div id="pagecontent">
    <h3>CMS - Personal</h3>

    <h3 id="tableTitle">Account info</h3>
    <table id="users" class="table table-striped">
        <thead class="thead-light">
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Role</th>
        </thead>
        <tbody id="table-body"></tbody>
    </table>
    <hr>
    <div style="margin: auto;width: 30%;">
        <h5 id="updateTitle">Update information</h5>
        <label for="first_name">First name: </label>
        <input class="form-control" type="text" name="first_name" id="first_name" placeholder="First Name">
        <label for="last_name">Last name: </label>
        <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Last Name">
        <label for="email">Email: </label>
        <input class="form-control" type="email" name="email" id="email" placeholder="Email">
        <div style="text-align: center;">
            <button class="btn btn-primary mt-2" onclick="updateSelf()">Edit user</button>
            <a class="btn btn-warning mt-2" href="/cms/resetpassword">Reset password</a>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    document.onload = getOwnInfo();

    function getOwnInfo() {
        $.ajax({
            type: 'GET',
            url: '/cms/getOwnInfo',
        }).done(function(res) {
            makeTable(res);
        })
    }

    function updateSelf() {
        first_name = document.getElementById("first_name").value;
        last_name = document.getElementById("last_name").value;
        email = document.getElementById("email").value;

        $.ajax({
            type: 'POST',
            url: '/cms/updateSelf',
            data: {
                first_name: first_name,
                last_name: last_name,
                email: email
            }
        }).done(function(res) {
            getOwnInfo();
            alert(res);
        })
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
        };
        fillInfo(res);
    }

    function fillInfo(res) {
        document.getElementById("first_name").value = res.first_name;
        document.getElementById("last_name").value = res.last_name;
        document.getElementById("email").value = res.email;
    }
</script>