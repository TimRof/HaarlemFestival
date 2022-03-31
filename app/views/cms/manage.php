<?php
$pageTitle = "CMS - Manage";
include_once __DIR__ . '/../cmsnav.php';
?>

<div id="pagecontent">
    <h3>CMS - Manage Pages</h3>
    <h5>Overview Pages</h5>
    <label for="event_types">Event type: </label>
    <div>
        <select class="form-select" name="event_types" id="event_types"></select>
    </div>
    <div>
        <label for="title">Page title: </label>
        <input class="form-control" type="text" name="titleInput" id="titleInput" />
        <div class="mt-3">
            <label for="fileUpload">Upload image: </label>
            <div class="input-group">
                <input class="form-control" type="file" name="fileUpload" id="fileUpload" />
                <div class="input-group-append">
                    <button class="btn btn-warning" onclick="resetFile()">Reset</button>
                </div>
            </div>

        </div>
        <label for="imagePreview">Image preview: </label>
        <img name="imagePreview" id="imagePreview" alt="Event Preview Image" style="border-radius: 100%;
  height: 150px;
  width: 150px;
  background: #ccc;
  margin: 20px;">
        <input type="text" id="oldFileName" hidden>
    </div>
    <label for="description">Page description: </label>
    <!-- Create the editor container -->
    <div id="editor" style="height: 30%;"></div>

    <textarea name="description" style="display:none" id="hiddenArea"></textarea>
    <div style="text-align: right">
        <button class="btn btn-primary mt-2" id="submit">
            Save changes
        </button>
    </div>

</div>

<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet" />

<!-- Initialize Quill editor -->
<script>
    var quill = new Quill("#editor", {
        theme: "snow",
    });

    $("#identifier").on("submit", function() {
        $("#hiddenArea").val($("#editor").html());
    })
</script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="/js/cms/manage.js"></script>