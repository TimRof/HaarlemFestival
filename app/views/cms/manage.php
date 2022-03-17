<?php
$pageTitle = "CMS - Manage";
include_once __DIR__ . '/../cmsnav.php';
?>

<div id="pagecontent">
    <h3>CMS - Manage Pages</h3>
    <h5>Overview Pages</h5>
    <label for="event_types">Event type: </label>
    <div><select class="form-control" name="event_types" id="event_types">
        </select></div>
    <div>
        <label for="title">Page title: </label>
        <input class="form-control" type="text" name="titleInput" id="titleInput">
        <div>
            <label for="image">Image URL: </label>
            <input class="form-control" type="text" name="imageInput" id="imageInput" value="">
            <label for="imagePreview">Image preview: </label>
            <img name="imagePreview" id="imagePreview" alt="Event Preview Image" style="border-radius: 100%;
              height: 150px;
              width: 150px;
              background: #ccc;
              margin: 20px;">
        </div>
    </div>
    <label for="description">Page description: </label>
    <!-- <div><textarea name="description" id="description" cols="50" rows="10"></textarea></div> -->
    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Create the editor container -->
    <div style="height: 30%;" id="editor">
        <p>Hello World!</p>
        <p>Some initial <strong>bold</strong> text</p>
        <p><br></p>
    </div>

    <!-- Include the Quill library -->

    <div style="text-align: right;"><button class="btn btn-primary mt-2" onclick="updateContent()">Save changes</button></div>
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
    var editorDirty = 0;
    var titleDirty = false;
    var imageDirty = false;
    quill.on('text-change', function(delta, oldDelta, source) {
        if (editorDirty < 3) {
            editorDirty++;
        }
    });
    $('#titleInput').on('input', function(e) {
        titleDirty = true;;
    });
    $('#imageInput').on('input', function(e) {
        imageDirty = true;
    });
    $('#imageInput').on('input', function(e) {
        setImage(this.value);
    });

    function setImage(val) {
        $('#imagePreview').prop('src', val);
    }

    function getEventTypes() {
        $.ajax({
            type: 'GET',
            url: '/events/getEventTypes',
        }).done(function(res) {
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
    $("#event_types").change(function() {
        var newVal = $(this).val();
        if (!checkEdit()) {
            $(this).val($.data(this, 'val'));
            return;
        } else {
            getContent(this);
        }
        $.data(this, 'val', newVal);
    })

    function getContent(select) {
        $.ajax({
            type: 'GET',
            url: '/events/getEventOverview',
            data: {
                id: select.value
            }
        }).done(function(res) {
            titleDirty = 0;
            imageDirty = 0;
            editorDirty = 0;
            fillPage(res);
        })
    }

    function checkEdit() {
        if (editorDirty == 2 || titleDirty || imageDirty) {
            var text = "Changes not saved!\nAre you sure you want to switch?";
            if (confirm(text) == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    function fillPage(res) {
        var title = document.getElementById('titleInput');
        title.value = res.title;
        quill.root.innerHTML = res.description;
        editorDirty = 0;
        var image = document.getElementById('imageInput');
        image.value = res.image;
        setImage(res.image);
    }

    function updateContent() {
        description = quill.root.innerHTML;
        id = document.getElementById('event_types').value;
        title = document.getElementById('titleInput').value;
        image = document.getElementById('imageInput').value;

        $.ajax({
            type: 'POST',
            url: '/events/updateContent',
            data: {
                id: id,
                title: title,
                description: description,
                image: image
            }
        }).done(function(res) {
            if (!res) {
                alert("Content changed!");
                editorDirty = 0;
                titleDirty = false;
                imageDirty = false;
            } else {
                alert(res);
            }
        })
    }
</script>