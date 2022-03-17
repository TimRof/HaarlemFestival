<?php
$pageTitle = "CMS";
include_once __DIR__ . '/../cmsnav.php';
?>
<div id="pagecontent">
    <h3>CMS</h3>
    <h2>Quicklinks</h2>
    <br>
    <h4>Event management</h4>
    <ul>
        <li><a href="/cms/addevent?type=food">Food</a></li>
        <ul>
            <li><a href="/cms/restaurants">Restaurants</a></li>
        </ul>
        <li><a href="/cms/addevent?type=history">History</a></li>
        <ul>
            <li><a href="/cms/tours">Tours</a></li>
            <li><a href="/cms/tourlocations">Tour locations</a></li>
        </ul>
        <li><a href="/cms/addevent?type=jazz">Jazz</a></li>
        <ul>
            <li><a href="/cms/venues">Venues</a></li>
            <li><a href="/cms/acts">Acts</a></li>
        </ul>
    </ul>
    <h4>User management</h4>
    <ul>
        <li><a href="/cms/users">Users</a></li>
        <li><a href="/cms/users">Account info</a></li>
    </ul>

    <!-- <?php if (isset($_SESSION['user_id'])) {
                echo "Logged in: " . htmlspecialchars($_SESSION['loggedin']);
                echo "<br>UserID: " . htmlspecialchars($_SESSION['user_id']);
                echo "<br>PermissionsID: " . htmlspecialchars($_SESSION['permission']);
            }
            ?> -->
</div>