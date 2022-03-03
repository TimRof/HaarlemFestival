<h1><a href="/">The Haarlem Festival</a></h1>

<h3>CMS</h3>
<div>
    <p>Overview Pages</p>
    <label for="event_types">Event type: </label>
    <div><select name="event_types" id="event_types" onchange="getContent(this)">
        </select></div>
    <label for="title">Title: </label>
    <div><input type="text" name="title" id="title"></div>
    <label for="description">Description: </label>
    <!-- <div><textarea name="description" id="description" cols="50" rows="10"></textarea></div> -->
    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Create the editor container -->
    <div id="editor">
        <p>Hello World!</p>
        <p>Some initial <strong>bold</strong> text</p>
        <p><br></p>
    </div>

    <!-- Include the Quill library -->

    <div><button onclick="updateContent()">Change</button></div>
</div>
<div>
    <p>Events</p>
</div>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    document.onload = getEventTypes();

    function getEventTypes() {
        $.ajax({
            type: 'GET',
            url: '/cms/getEventTypes',
        }).done(function(res) {
            // console.log(res);
            makeEventTypes(res);
        })
    }

    function makeEventTypes(res) {
        document.getElementById('event_types').innerHTML = "";
        var select = document.getElementById('event_types');

        for (const type of res) {
            var option = document.createElement('option');
            option.value = type.id;

            var description = document.createTextNode(type.name);
            option.appendChild(description);

            select.appendChild(option);
        }
        getContent(select);
    }

    function getContent(select) {
        $.ajax({
            type: 'GET',
            url: '/events/getEventOverview',
            data: {
                id: select.value
            }
        }).done(function(res) {
            // console.log(res);
            fillPage(res);
        })
    }

    function fillPage(res) {
        var title = document.getElementById('title');
        title.value = res.title;
        quill.root.innerHTML = res.description;
    }

    function updateContent() {
        description = quill.root.innerHTML;
        console.log(description);
        id = document.getElementById('event_types').value;
        title = document.getElementById('title').value;

        $.ajax({
            type: 'POST',
            url: '/events/updateContent',
            data: {
                id: id,
                title: title,
                description: description
            }
        }).done(function(res) {
            console.log(res);
            if (!res) {
                alert("Content changed!");
            } else {
                alert("Something went wrong!");
            }
        })
    }
</script>