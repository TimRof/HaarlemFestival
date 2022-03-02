<h1><a href="/">The Haarlem Festival</a></h1>

<h3>CMS</h3>

<ul>
    <li><a href="/cms">overview</a></li>
    <li><a href="/cms/manage">manage pages</a></li>
    <li><a href="/cms/users">users</a></li>
    <li><a href="/cms/archive">archived pages</a></li>
</ul>
<ul>
    <li><a href="/cms/adduser">add user</a></li>
    <li><a href="/cms/logout">logout</a></li>
</ul>

<?php if (isset($_SESSION['user_id'])) {
    echo htmlspecialchars($_SESSION['loggedin']);
    echo htmlspecialchars($_SESSION['user_id']);
    echo htmlspecialchars($_SESSION['permission']);
}
?>