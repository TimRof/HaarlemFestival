<?php
if (!empty($_SESSION['email'])) {
    $email = $_SESSION['email'];
    unset($_SESSION['email']);
}
$pageTitle = "CMS - Sign in";
include_once __DIR__ . '/../cmsnav.php';
?>
<div id="pagecontent" style="width:15%">
    <h3>CMS - Sign in</h3>

    <form method="post" action="/cms/login" id="formLogin">
        <div>
            <label class="inputlabel" for="inputEmail">Email</label>
            <input class="form-control" type="email" id="inputEmail" name="email" placeholder="Email address" value="<?php if (!empty($email)) {
                                                                                                                            echo $email;
                                                                                                                        } ?>" <?php if (empty($email)) { ?> autofocus <?php } ?>>
        </div>
        <div>
            <label class="inputlabel" for="inputPassword">Password</label>
            <input class="form-control" type="password" id="inputPassword" name="password" placeholder="Password" <?php if (!empty($email)) { ?> autofocus <?php } ?>>
        </div>

        <div>
            <div>
                <button class="btn btn-primary mt-2" type="submit">Sign in</button>
            </div>
        </div>
        <div><?php if (!empty($email)) { ?>
                <hr>
                <p class="text-danger">
                    <b>Incorrect Credentials</b><br>
                    Verify your email address and password and try again.
                </p>
            <?php } ?>
        </div>
    </form>
</div>