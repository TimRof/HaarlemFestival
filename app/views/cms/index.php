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
        <li><a href="/cms/addactivities?type=food">Food</a></li>
        <ul>
            <li><a href="/cms/restaurants">Restaurants</a></li>
        </ul>
        <li><a href="/cms/addactivities?type=history">History</a></li>
        <ul>
            <li><a href="/cms/tours">Tours</a></li>
            <li><a href="/cms/tourlocations">Tour locations</a></li>
        </ul>
        <li><a href="/cms/addactivities?type=jazz">Jazz</a></li>
        <ul>
            <li><a href="/cms/venues">Venues</a></li>
            <li><a href="/cms/jazzacts">Acts</a></li>
        </ul>
    </ul>
    <h4>User management</h4>
    <ul>
        <li><a href="/cms/users">Users</a></li>
        <li><a href="/cms/users">Account info</a></li>
    </ul>
    <h4>Page management</h4>
    <ul>
        <li><a href="/cms/manage">Overview pages</a></li>
    </ul>
</div>