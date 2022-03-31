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
    <form method="post" action="/cms/login" id="formLogin" name="formLogin">
        <div>
            <label class="inputlabel" for="inputEmail">Email</label>
            <input class="form-control" type="email" id="inputEmail" name="email" placeholder="Email address" value="
            <?php if (!empty($email)) {
                echo $email;
            } ?>" <?php if (empty($email)) { ?> autofocus <?php } ?> required>
        </div>
        <div>
            <label class="inputlabel" for="inputPassword">Password</label>
            <input class="form-control" type="password" id="inputPassword" name="password" placeholder="Password" <?php if (!empty($email)) { ?> autofocus <?php } ?> required>
        </div>

        <div>
            <div>
                <button class="btn btn-primary mt-2" type="submit">Sign in</button>
            </div>
        </div>
        <div class="g-recaptcha mt-3" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaResponseExpiry" data-error-callback="onRecaptchaError">
        </div>

        <div id="captchaError" hidden>
            <hr>
            <p role="alert" class="text-danger">
                <b>Invalid Captcha</b><br>
                Please fill in the captcha.
            </p>
        </div>
        <div><?php if (!empty($email)) { ?>
                <hr>
                <p id="loginError" role="alert" class="text-danger">
                    <b>Incorrect Credentials</b><br>
                    Verify your email address and password and try again.
                </p>
            <?php } ?>
        </div>
    </form>
</div>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="/js/cms/login.js"></script>