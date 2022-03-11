<h1><a href="/">The Haarlem Festival</a></h1>

<h3>CMS</h3>
<div id="main">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    document.onload = startButtons();

    var shown = "";

    function startButtons() {
        shown = "";
        main.innerHTML = "";
        $.ajax({
            type: 'GET',
            url: '/events/getEventTypes',
        }).done(function(res) {
            res.forEach(element => {
                var button = document.createElement('button');
                button.innerHTML = element.name;
                button.value = element.name;
                button.onclick = function() {
                    eventChosen(this.value)
                };
                main.appendChild(button);
            });
        })
    }

    function backToStart() {
        var options = document.createElement('div');
        options.id = "options";
        var button = document.createElement('button');
        button.innerHTML = "Back to start";
        button.onclick = function() {
            startButtons();
        };
        options.appendChild(button);
        main.appendChild(options);
    }

    function eventChosen(value) {
        main.innerHTML = "";
        var container = document.createElement('div');
        container.id = "container";
        main.appendChild(container);
        backToStart();
        switch (value) {
            case "Food":
                foodEvent();
                break;
            case "History":
                historyEvent();
                break;
            case "Jazz":
                console.log("jazz");
                break;
            default:
                break;
        }
    }

    function addDefInputs($str) {
        var nameInput = document.createElement('input');
        nameInput.placeholder = $str + " name";
        nameInput.id = "name";
        nameInput.required = "name";
        var desInput = document.createElement('input');
        desInput.placeholder = "Description";
        desInput.id = "description";
        var couInput = document.createElement('input');
        couInput.placeholder = "Country";
        couInput.id = "country";
        couInput.value = "Netherlands";
        var citInput = document.createElement('input');
        citInput.placeholder = "City";
        citInput.id = "city";
        citInput.value = "Haarlem";
        var zipInput = document.createElement('input');
        zipInput.placeholder = "Zipcode";
        zipInput.id = "zipcode";
        var adInput = document.createElement('input');
        adInput.placeholder = "Address";
        adInput.id = "address";

        container.appendChild(nameInput);
        container.appendChild(desInput);
        container.appendChild(couInput);
        container.appendChild(citInput);
        container.appendChild(zipInput);
        container.appendChild(adInput);
    }

    function historyEvent() {
        addHisButtons();
    }

    function addHisButtons() {
        var button = document.createElement('button');
        button.innerHTML = "Add location";
        button.id = "add_location";
        button.onclick = function() {
            addLocation();
        };
        options.appendChild(button);
    }

    function addLocation() {
        if (shown == "") {
            shown = "addL";
            add_location.remove();
        } else {
            container.innerHTML = "";
            add.remove();
            cancel.remove();
            addHisButtons();
            shown = "";
            return;
        }

        addDefInputs("Location")

        var butAdd = document.createElement('button');
        butAdd.innerHTML = "Add";
        butAdd.id = "add";
        butAdd.onclick = function() {
            addLoc();
        };
        var butCan = document.createElement('button');
        butCan.innerHTML = "Cancel";
        butCan.id = "cancel";
        butCan.onclick = function() {
            addLocation();
        };

        options.appendChild(butAdd);
        options.appendChild(butCan);
    }

    function foodEvent() {
        addResButtons();
    }

    function addResButtons() {
        var button = document.createElement('button');
        button.innerHTML = "Add restaurant";
        button.id = "add_restaurant";
        button.onclick = function() {
            addRestaurant();
        };
        options.appendChild(button);
    }

    function addRestaurant() {
        if (shown == "") {
            shown = "addR";
            add_restaurant.remove();
        } else {
            container.innerHTML = "";
            add.remove();
            cancel.remove();
            addResButtons();
            shown = "";
            return;
        }

        addDefInputs("Restaurant");

        var butAdd = document.createElement('button');
        butAdd.innerHTML = "Add";
        butAdd.id = "add";
        butAdd.onclick = function() {
            addRes();
        };
        var butCan = document.createElement('button');
        butCan.innerHTML = "Cancel";
        butCan.id = "cancel";
        butCan.onclick = function() {
            addRestaurant();
        };

        options.appendChild(butAdd);
        options.appendChild(butCan);
    }

    function clearDefFields() {
        document.getElementById("name").value = "";
        document.getElementById("description").value = "";
        document.getElementById("zipcode").value = "";
        document.getElementById("address").value = "";
    }

    function addRes() {
        var name = document.getElementById("name").value;
        var description = document.getElementById("description").value;
        var country = document.getElementById("country").value;
        var city = document.getElementById("city").value;
        var zipcode = document.getElementById("zipcode").value;
        var address = document.getElementById("address").value;

        $.ajax({
            type: 'POST',
            url: '/events/addRestaurant',
            data: {
                name: name,
                description: description,
                country: country,
                city: city,
                zipcode: zipcode,
                address: address
            }
        }).done(function(res) {
            alert(res);
            clearDefFields();
        })
    }

    function addLoc() {
        var name = document.getElementById("name").value;
        var description = document.getElementById("description").value;
        var country = document.getElementById("country").value;
        var city = document.getElementById("city").value;
        var zipcode = document.getElementById("zipcode").value;
        var address = document.getElementById("address").value;

        $.ajax({
            type: 'POST',
            url: '/events/addLocation',
            data: {
                name: name,
                description: description,
                country: country,
                city: city,
                zipcode: zipcode,
                address: address
            }
        }).done(function(res) {
            alert(res);
            clearDefFields();
        })
    }
</script>