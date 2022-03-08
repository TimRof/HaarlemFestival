<h1><a href="/">The Haarlem Festival</a></h1>

<h3>CMS</h3>

<form method="post" action="/cms/login" id="formLogin">
    <div>
        <label class="inputlabel" for="inputEmail">Email</label>
        <input type="email" id="inputEmail" name="email" placeholder="Email address" value="<?php if (!empty($email)) {
                                                                                                echo $email;
                                                                                            } ?>admin@admin.admin" <?php if (empty($email)) { ?> autofocus <?php } ?>>
    </div>
    <div>
        <label class="inputlabel" for="inputPassword">Password</label>
        <input type="password" id="inputPassword" name="password" placeholder="Password" <?php if (!empty($email)) { ?> autofocus <?php } ?> value="secret123">
    </div>

    <div>
        <div>
            <button type="submit">Login</button>
        </div>
    </div>
    <div><?php if (!empty($user) && $user == false && !is_null($email)) { ?>
            <hr>
            <p role="alert">
                <b>Incorrect Credentials</b><br>
                Verify your email address and password and try again.
            </p>
        <?php } ?>
    </div>
</form>