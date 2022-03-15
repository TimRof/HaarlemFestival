<?php
include_once __DIR__ . '/../cmsnav.php';
$PageTitle = "CMS - Add User";
?>
<div id="pagecontent">
    <h3>CMS - Add User</h3>
</div>
<div>
    <form method="post" action="/cms/signup" id="formSignup">
        <div>
            <label for="inputName">First name</label>
            <input class="form-control" id="inputName" name="firstName" placeholder="First Name" maxlength="50" autofocus required value="test">
        </div>
        <div>
            <label for="inputName">Last name</label>
            <input class="form-control" id="inputName" name="lastName" placeholder="Last Name" maxlength="50" autofocus required value="test">
        </div>
        <div>
            <label for="inputName">Email</label>
            <input class="form-control" id="inputEmail" type="email" name="email" placeholder="Email address" maxlength="200" value="test@test.test">
        </div>
        <div>
            <label for="inputName">Password</label>
            <input class="form-control" type="password" id="inputPassword" name="password" placeholder="Password" maxlength="128" value="testtest1">
        </div>
        <div>
            <label for="inputName">Repeat password</label>
            <input class="form-control" type="password" id="inputPasswordConfirmation" name="password_confirmation" placeholder="Repeat password" maxlength="128" value="testtest1">
        </div>
        <div>
            <button class="btn btn-primary mt-2" type="submit">Sign up</button>
        </div>
    </form>
</div>