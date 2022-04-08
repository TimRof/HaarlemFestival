document.onload = getEventTypes();
var editorDirty = 0;
var titleDirty = false;
var imageDirty = false;
var fileName = "";
quill.on("text-change", function (delta, oldDelta, source) {
  if (editorDirty < 3) {
    editorDirty++;
  }
});
$("#titleInput").on("input", function (e) {
  titleDirty = true;
});
$("#imageInput").on("input", function (e) {
  imageDirty = true;
});
$("#imageInput").on("input", function (e) {
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
  }).done(function (res) {
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
$("#event_types").change(function () {
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
  }).done(function (res) {
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
document.getElementById("fileUpload").onchange = function () {
  if (document.getElementById("fileUpload").value != "") {
    if (this.files[0].size > 500000) {
      alert("File is too large!");
      this.value = "";
    } else {
      editorDirty++;
      const [file] = document.getElementById("fileUpload").files;
      if (file) {
        $("#imagePreview").prop("src", URL.createObjectURL(file));
      }
    }
  }
};
$("#submit").on("click", function () {
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
  }).done(function (res) {
    if (res === "Content updated!") {
      document.getElementById("oldFileName").value = fileName;
    }
    alert(res);
  });
});
