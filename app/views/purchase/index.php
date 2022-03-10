<head>
    <link rel="stylesheet" href="../styles/purchase.css">
</head>

<h1><a href="/">The Haarlem Festival</a></h1>

<h3>Purchase</h3>

<div id="event_list">
    <div class="event_style" id="event_item">
        <p>event item</p>
    </div>
</div>

<?php 

?>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    document.onload = getEvents();

    function getEvents() {
        console.log("getEvents active");
        $.ajax({
            type: 'GET',
            url: '/events/getAllEvents',
            data: {

            }
        }).done(function(res) {
            makeEvents(res);
        })
    }

    function makeEvents(res) {
        console.log("makeEvents active");
        // foreach ($events as $event_item) {

        // }
        var event = document.createElement('div');
        event.setAttribute('class', 'event_type');
        event.appendChild(document.createTextNode('Event'));
        console.log(res);

        document.getElementById("event_list").appendChild(event);
    }
</script>