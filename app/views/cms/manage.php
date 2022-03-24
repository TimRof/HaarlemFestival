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
<script>
    document.onload = getEventTypes();
    var editorDirty = 0;
    var titleDirty = false;
    var imageDirty = false;
    var fileName = "";
    quill.on("text-change", function(delta, oldDelta, source) {
        if (editorDirty < 3) {
            editorDirty++;
        }
    });
    $("#titleInput").on("input", function(e) {
        titleDirty = true;
    });
    $("#imageInput").on("input", function(e) {
        imageDirty = true;
    });
    $("#imageInput").on("input", function(e) {
        setImage(this.value);
    });

    function setImage(val) {
        $("#imagePreview").prop("src", val);
    }

    function resetFile() {
        document.getElementById("fileUpload").value = "";
    }

    function getEventTypes() {
        $.ajax({
            type: "GET",
            url: "/events/getEventTypes",
        }).done(function(res) {
            makeEventTypes(res);
        });
    }

    function makeEventTypes(res) {
        document.getElementById("event_types").innerHTML = "";
        var select = document.getElementById("event_types");

        for (const type of res) {
            var option = document.createElement("option");
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
            $(this).val($.data(this, "val"));
            return;
        } else {
            getContent(this);
        }
        $.data(this, "val", newVal);
    });

    function getContent(select) {
        $.ajax({
            type: "GET",
            url: "/events/getEventOverview",
            data: {
                id: select.value,
            },
        }).done(function(res) {
            titleDirty = 0;
            imageDirty = 0;
            editorDirty = 0;
            fillPage(res);
        });
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
        let title = document.getElementById("titleInput");
        title.value = res.title;
        quill.root.innerHTML = res.description;
        editorDirty = 0;
        fileName = "";
        document.getElementById("fileUpload").value = "";
        document.getElementById("oldFileName").value = res.image;
        setImage(res.image);
    }
    // check file size
    document.getElementById("fileUpload").onchange = function() {
        if (document.getElementById("fileUpload").value != "") {
            if (this.files[0].size > 500000) {
                alert("File is too large!");
                this.value = "";
            } else {
                console.log("dirt");
                editorDirty++;
                const [file] = document.getElementById("fileUpload").files;
                if (file) {
                    $("#imagePreview").prop("src", URL.createObjectURL(file));
                }
            }
        }
    };
    $("#submit").on("click", function() {
        var fd = new FormData();
        fd.append("title", document.getElementById("titleInput").value);
        fd.append("description", quill.root.innerHTML);
        fd.append("id", document.getElementById("event_types").value);
        fd.append("fileUpload", document.getElementById("fileUpload").files[0]);
        fd.append("oldFileName", document.getElementById("oldFileName").value);
        if (document.getElementById("fileUpload").value != "") {
            fileName = document.getElementById("fileUpload").files[0].name;
        }
        $.ajax({
            method: "POST",
            url: "/events/updateContent",
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
        }).done(function(res) {
            if (res === "Content updated!") {
                document.getElementById("oldFileName").value = fileName;
            }
            alert(res);
        });
    });
</script>