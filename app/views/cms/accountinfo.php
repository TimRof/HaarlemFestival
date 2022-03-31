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
            <a class="btn btn-warning mt-2" href="/cms/changepassword">Change password</a>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="/js/cms/accountinfo.js"></script>