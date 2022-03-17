<!-- <?php $root = $_SERVER["DOCUMENT_ROOT"];
include($root . '/sub/header.php'); ?> -->

<!DOCTYPE html>
<head>
    <title>Jazz</title>
    
</head>
<div class="overview">
<div class="container">
<h1><a href="/">The Haarlem Festival</a></h1>

<h3 id="title"></h3>
<link rel="stylesheet" href="../styles/jazz.css">
<div id="image-container">
    <img id="image" src="" alt="Food Overview Image" style="border-radius: 100%;
                height: 250px;
                width: 250px;
                background: #ccc;
                margin: 20px;
                box-shadow: rgba(0, 0, 0, 0.15) 0px 3px 3px 0px;">
</div>
<content class="center-container">
    <div id="description"></div>
</content>

<a id="action-title" href="/purchase?filter=jazz"><h2>GET YOUR TICKETS <b style="color:#005D9F">NOW</b></h2></a>

<div>PARTICIPATING <b style="color:#005D9F">ARTISTS</b></div>

<div id="part-container">
    <div class="upcoming-event">
        <div>
            <h3>The Gumbo Kings</h3>
            <p>The Gumbo Kings are five-headed Soul Monster that combines the groove of New Orleans Funk with the grittiness of Delta Blues and the melodies of Memphis Soul.</p>
        </div>
        <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.4QWzwjCTKZAEs7pP4OTD1AHaHa%26pid%3DApi&f=1">
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    document.onload = getContent();
    document.onload = getEvents();

    function getContent() {

        $.ajax({
            type: 'GET',
            url: '/events/getEventOverview',
            data: {
                id: 3
            }
        }).done(function(res) {
            fillPage(res);
        })
    }

    function fillPage(res) {
        var t = document.createTextNode(res.title);
        var title = document.getElementById('title');
        title.appendChild(t);

        var description = document.getElementById('description');
        description.innerHTML = res.description;

        var image = document.getElementById('image');
        image.src = res.image;
    }

    function getEvents() {
        $.ajax({
            type: 'GET',
            url: '/events/getAllEvents',
        }).done(function(res) {
            makeEvents(res);
        })
    }

    function makeEvents(res) {
        console.log(res);
        for (let i = 0; i < res.length; i++) {
            console.log(res[i]);
            event = document.createElement('div');
            event.setAttribute('class', 'upcoming-event');

            event_information = document.createElement('div');

            title = document.createElement('h3');
            title.appendChild(document.createTextNode(res[i].name));

            content = document.createElement('p');
            content.appendChild(document.createTextNode(res[i].content));

            // image = document.getElementById('image');
            // image.src = res[i].image;

            event.appendChild(event_information);
            event_information.appendChild(title);
            event_information.appendChild(content);
            // event.appendChild(image);

            document.getElementById("part-container").appendChild(event);
        }
    }
</script>