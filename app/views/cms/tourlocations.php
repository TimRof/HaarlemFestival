<?php
$pageTitle = "CMS - Tour Locations";
include_once __DIR__ . '/../cmsnav.php';
?>
<div id="pagecontent">
    <h3>CMS - Tour Locations</h3>

    <div class="backTitle">
        <a class="btn btn-outline-dark" href="/cms/addactivities?type=history">Back</a>
        <h3 id="tableTitle">Overview</h3>
    </div>
    <div>
        <button type="button" class="btn btn-outline-danger" id="clearbutton" hidden>Clear search</button>
        <div class="input-group" style="width: 30%; float:right">
            <input type="search" class="form-control rounded" placeholder="Search" id="searchbox" />
            <button type="button" class="btn btn-outline-primary" id="searchbutton">search</button>
        </div>
    </div>
    <div>
        <table id="users" class="table table-striped">
            <thead class="thead-light">
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Country</th>
                <th>City</th>
                <th>Zipcode</th>
                <th>Address</th>
            </thead>
            <tbody id="table-body"></tbody>
        </table>
        <div id="pageNav">
            <div style="float:left" id="previousButton"></div>
            <div style="float:right" id="nextButton"></div>
        </div>
    </div>

    <hr style="clear: both">
    <div style="margin: auto;width: 30%;">
        <h5 id="updateTitle">Update (none selected)</h5>
        <label for="name">Location name: </label>
        <input class="form-control" type="text" name="name" id="name" placeholder="Name">
        <label for="description">Location description: </label>
        <textarea class="form-control" name="description" id="description" placeholder="Description" rows="7"></textarea>
        <label for="country">Country: </label>
        <input class="form-control" type="country" name="country" id="country" placeholder="Country">
        <label for="city">City: </label>
        <input class="form-control" type="city" name="city" id="city" placeholder="City">
        <label for="zipcode">Zipcode: </label>
        <input class="form-control" type="zipcode" name="zipcode" id="zipcode" placeholder="Zipcode">
        <label for="address">Address: </label>
        <input class="form-control" type="address" name="address" id="address" placeholder="Address">
        <div style="text-align: center;">
            <button class="btn btn-primary optionsbutton mt-2" onclick="updateTourLocation()">Make changes</button>
            <button class="btn btn-danger optionsbutton mt-2" onclick="deleteTourLocation()">Delete</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="/js/cms/tourlocations.js"></script>