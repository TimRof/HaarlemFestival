<?php
$pageTitle = "CMS - Add User";
include_once __DIR__ . '/../cmsnav.php';
?>
<div id="pagecontent">
    <h3>CMS - Add User</h3>

    <div>
        <form method="post" action="/cms/signup" id="formSignup">
            <div>
                <label for="inputName">First name</label>
                <input class="form-control" id="inputName" name="firstName" placeholder="First Name" maxlength="50" autofocus required>
            </div>
            <div>
                <label for="inputName">Last name</label>
                <input class="form-control" id="inputName" name="lastName" placeholder="Last Name" maxlength="50" required>
            </div>
            <div>
                <label for="inputName">Email</label>
                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="Email address" maxlength="200" required>
            </div>
            <div>
                <label for="inputName">Password</label>
                <input class="form-control" type="password" id="inputPassword" name="password" placeholder="Password" maxlength="128" required>
            </div>
            <div>
                <label for="inputName">Repeat password</label>
                <input class="form-control" type="password" id="inputPasswordConfirmation" name="password_confirmation" placeholder="Repeat password" required>
            </div>
            <div>
                <button class="btn btn-primary mt-2" type="submit">Add user</button>
            </div>
        </form>
    </div>
</div>