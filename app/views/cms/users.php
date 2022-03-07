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

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    document.onload = getUsers();

    function getUsers() {
        $.ajax({
            type: 'GET',
            url: '/cms/getUsers',
        }).done(function(res) {
            makeTable(res);
        })
    }

    function makeTable(res) {
        var table = document.getElementById("usersTableBody");
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
            console.log('Clicked row with id: ', tr.id)
        }
    })
</script>