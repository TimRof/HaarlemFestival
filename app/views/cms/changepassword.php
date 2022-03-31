<?php
$pageTitle = "CMS - Change Password";
include_once __DIR__ . '/../cmsnav.php';
?>
<div id="pagecontent">
    <h3>CMS - Change password</h3>

    <div style="margin: auto;width: 30%;">
        <label for="first_name">Current password: </label>
        <input class="form-control" type="password" name="current_password" id="current_password" placeholder="Password">

        <label for="last_name">New password: </label>
        <input class="form-control" type="password" name="new_password" id="new_password" placeholder="Password">
        <div><b class="error" id="newError"></b></div>
        <label for="last_name">Repeat password: </label>
        <input class="form-control" type="password" name="check_password" id="check_password" placeholder="Password">
        <div><b class="error" id="checkError"></b></div>
        <div style="text-align: center;">
            <a class="btn btn-danger mt-2" href="/cms/accountinfo">Back</a>
            <button class="btn btn-primary mt-2" onclick="submit()">Change password</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="/js/cms/changepassword.js"></script>