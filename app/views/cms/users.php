<h1><a href="/">The Haarlem Festival</a></h1>

<h3>CMS</h3>
<a href="/cms/adduser">add user</a>

<ul id="users_list"></ul>
<table id="usersTable" style="border: thick solid #333;">
    <thead>
        <tr>
            <th colspan="6">Users</th>
        </tr>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created on</th>
            <th>Updated at</th>
        </tr>
    </thead>
    <tbody id="usersTableBody">
    </tbody>
</table>
<div>

    <label for="first_name">First name: </label>
    <input type="text" name="first_name" id="first_name" placeholder="First Name">
    <label for="last_name">Last name: </label>
    <input type="text" name="last_name" id="last_name" placeholder="Last Name">
    <label for="email">Email: </label>
    <input type="email" name="email" id="email" placeholder="Email">
    <label for="role_types">User Role: </label>
    <select name="role_types" id="role_types">
    </select>
</div>
<button onclick="updateUser()">Edit</button>
<button onclick="deleteUser()">Delete</button>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    var selected;
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
        var table = document.getElementById("usersTableBody");
        table.innerHTML = "";
        for (const user of res) {

            var row = table.insertRow();
            row.id = user.id;

            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);

            cell1.innerHTML = user.id;
            cell2.innerHTML = user.first_name + " " + user.last_name;
            cell3.innerHTML = user.email;
            switch (user.role_id) {
                case 1:
                    cell4.innerHTML = "User";
                    break;
                case 2:
                    cell4.innerHTML = "Administrator";
                    break;
                case 3:
                    cell4.innerHTML = "SuperAdministrator";
                    break;
                default:
                    break;
            }
            cell5.innerHTML = user.created_at;
            cell6.innerHTML = user.updated_at;
        }
    }
    document.addEventListener('click', function(e) {
        if (e.target.tagName.toLowerCase() === "td") {
            let tr = e.target.closest('tr');
            selected = tr.id;
            getUser(selected);
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
    }

    function clearInfo() {
        document.getElementById("first_name").value = null;
        document.getElementById("last_name").value = null;
        document.getElementById("email").value = null;
        document.getElementById("role_types").value = null;
        selected = null;
    }
</script>