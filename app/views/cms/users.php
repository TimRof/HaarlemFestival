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
            <option value="1">User</option>
            <option value="2">Admin</option>
            <option value="3">Super Admin</option>
        </select>
        <div style="text-align: center;">
            <button class="btn btn-primary optionsbutton mt-2" onclick="updateUser()">Make changes</button>
            <button class="btn btn-danger optionsbutton mt-2" onclick="deleteUser()">Delete</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="/js/cms/users.js"></script>