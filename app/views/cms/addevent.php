<h1><a href="/">The Haarlem Festival</a></h1>

<h3>CMS</h3>
<div>
    <h3 id="title"></h3>
</div>
<div id="main">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    document.onload = startButtons();

    var shown = "";

    // tour info
    var tourStops = 3;
    var tourName = "";
    var tourLang = "";

    // place start buttons
    function startButtons() {
        shown = "";
        main.innerHTML = "";
        title.innerHTML = "Pick an event"

        let foodB = document.createElement('button');
        foodB.innerHTML = "Food";
        foodB.value = "Food";
        foodB.onclick = function() {
            eventChosen(this.value)
        };
        main.appendChild(foodB);

        let histB = document.createElement('button');
        histB.innerHTML = "History";
        histB.value = "History";
        histB.onclick = function() {
            eventChosen(this.value)
        };
        main.appendChild(histB);

        let jazzB = document.createElement('button');
        jazzB.innerHTML = "Jazz";
        jazzB.value = "Jazz";
        jazzB.onclick = function() {
            eventChosen(this.value)
        };
        main.appendChild(jazzB);
    }

    // back to start button
    function backToStart() {
        var options = document.createElement('div');
        options.id = "options";
        let backBut = document.createElement('button');
        backBut.innerHTML = "Back to start";
        backBut.onclick = function() {
            startButtons();
        };
        options.appendChild(backBut);
        main.appendChild(options);
    }

    // check chosen event
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
                jazzEvent();
                break;
            default:
                break;
        }
    }

    // default inputs: name, description, country, city, zipcode, address
    function addDefInputs($str) {
        let nameInput = document.createElement('input');
        nameInput.placeholder = $str + " name";
        nameInput.id = "name";
        nameInput.required = "name";
        let desInput = document.createElement('input');
        desInput.placeholder = "Description";
        desInput.id = "description";
        let couInput = document.createElement('input');
        couInput.placeholder = "Country";
        couInput.id = "country";
        couInput.value = "Netherlands";
        let citInput = document.createElement('input');
        citInput.placeholder = "City";
        citInput.id = "city";
        citInput.value = "Haarlem";
        let zipInput = document.createElement('input');
        zipInput.placeholder = "Zipcode";
        zipInput.id = "zipcode";
        let adInput = document.createElement('input');
        adInput.placeholder = "Address";
        adInput.id = "address";

        container.appendChild(nameInput);
        container.appendChild(desInput);
        container.appendChild(couInput);
        container.appendChild(citInput);
        container.appendChild(zipInput);
        container.appendChild(adInput);
    }

    function jazzEvent() {
        title.innerHTML = "Jazz event";
        addJazButtons();
    }

    function addJazButtons() {
        let addloc = document.createElement('button');
        addloc.innerHTML = "Add venue";
        addloc.id = "add_location";
        addloc.onclick = function() {
            addJazzLocation();
        };
        options.appendChild(addloc);
    }

    // add venue for jazz
    function addJazzLocation() {
        if (shown == "") {
            shown = "addJL";
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

        // add button
        let butAdd = document.createElement('button');
        butAdd.innerHTML = "Add";
        butAdd.id = "add";
        butAdd.onclick = function() {
            addJazzLoc();
        };
        // cancel button
        let butCan = document.createElement('button');
        butCan.innerHTML = "Cancel";
        butCan.id = "cancel";
        butCan.onclick = function() {
            addJazzLocation();
        };

        options.appendChild(butAdd);
        options.appendChild(butCan);
    }

    function historyEvent() {
        title.innerHTML = "History event";
        addHisButtons();
    }

    function addHisButtons() {
        let addLoc = document.createElement('button');
        addLoc.innerHTML = "Add location";
        addLoc.id = "add_location";
        addLoc.onclick = function() {
            addRouteLocation();
        };
        options.appendChild(addLoc);

        let addTou = document.createElement('button');
        addTou.innerHTML = "Add tour";
        addTou.id = "add_tour";
        addTou.onclick = function() {
            addTour();
        };
        options.appendChild(addTou);
    }

    function addTour() {
        // reset tour info
        tourStops = 3;
        tourName = ""
        tourLang = ""
        if (shown == "") {
            shown = "addT";
            add_location.remove();
            add_tour.remove();
        } else {
            container.innerHTML = "";
            if ($('#add').length > 0) {
                add.remove();
            }
            if ($('#next').length > 0) {
                next.remove();
            }
            cancel.remove();
            addHisButtons();
            shown = "";
            return;
        }

        let butCan = document.createElement('button');
        butCan.innerHTML = "Cancel";
        butCan.id = "cancel";
        butCan.onclick = function() {
            addTour();
        };
        options.appendChild(butCan);

        tourInfo();
    }

    function tourInfo() {
        // check if back or new
        if ($('#back').length > 0) {
            container.innerHTML = "";
            back.remove();
            add.remove();
            let butCan = document.createElement('button');
            butCan.innerHTML = "Cancel";
            butCan.id = "cancel";
            butCan.onclick = function() {
                addTour();
            };
            options.appendChild(butCan);
        }
        // cancel button
        let butNext = document.createElement('button');
        butNext.innerHTML = "Next";
        butNext.id = "next";
        butNext.onclick = function() {
            chooseStops();
        };

        options.appendChild(butNext);

        // name input
        let nameLabel = document.createElement("label");
        nameLabel.htmlFor = "name";
        let nameText = document.createTextNode("Tour name: ");
        nameLabel.appendChild(nameText);

        let nameInput = document.createElement('input');
        nameInput.placeholder = "Tour name";
        nameInput.value = tourName;
        nameInput.id = "name";

        // language input
        let langLabel = document.createElement("label");
        langLabel.htmlFor = "language";
        let langText = document.createTextNode("Tour language: ");
        langLabel.appendChild(langText);

        let langInput = document.createElement('input');
        langInput.placeholder = "Tour language";
        langInput.value = tourLang;
        langInput.id = "language";

        // stops input
        let stopsLabel = document.createElement("label");
        stopsLabel.htmlFor = "stops";
        let stopsText = document.createTextNode("Number of stops (min 3, max 20): ");
        stopsLabel.appendChild(stopsText);

        let stopsInput = document.createElement("input");
        stopsInput.type = "number";
        stopsInput.id = "stops";
        stopsInput.min = "3";
        stopsInput.max = "20";
        stopsInput.value = tourStops;
        stopsInput.placeholder = "Number of stops";

        container.appendChild(nameLabel);
        container.appendChild(nameInput);
        container.appendChild(langLabel);
        container.appendChild(langInput);
        container.appendChild(stopsLabel);
        container.appendChild(stopsInput);
    }

    // choose stops for tour
    function chooseStops() {
        let stopsInput = document.getElementById("stops");
        let nameInput = document.getElementById("name");
        let langInput = document.getElementById("language");

        if (nameInput.value != "" && langInput.value != "") {
            if (stopsInput.value > 2) {
                if (stopsInput.value < 21) {
                    tourStops = document.getElementById("stops").value;
                    tourName = document.getElementById("name").value;
                    tourLang = document.getElementById("language").value;
                    container.innerHTML = "";
                    cancel.remove();
                    next.remove();

                    let butBac = document.createElement('button');
                    butBac.innerHTML = "Back";
                    butBac.id = "back";
                    butBac.onclick = function() {
                        tourInfo();
                    };
                    let butAdd = document.createElement('button');
                    butAdd.innerHTML = "Add Tour";
                    butAdd.id = "add";
                    butAdd.onclick = function() {
                        let inputs = document.getElementById('stops').getElementsByTagName('select');
                        let stops = [];
                        for (let index = 0; index < inputs.length; index++) {
                            //console.log("Stop " + inputs[index].id + ": " + inputs[index].value);
                            let tour_stop = {
                                stop_number: inputs[index].id,
                                tour_location_id: inputs[index].value
                            }
                            stops.push(tour_stop);
                        }
                        //console.log(stops);
                        makeTour(stops);
                    };
                    options.insertBefore(butBac, options.children[1]);
                    options.insertBefore(butAdd, options.children[2]);

                    getStops();
                } else {
                    alert("A tour can not have more than 20 stops!")
                }
            } else {
                alert("A tour should have atleast 3 stops!")
            }
        } else {
            alert("Name and language can not be empty!")
        }
    }

    function makeTour(stops) {
        let tour = {
            name: tourName,
            language: tourLang,
            stops: tourStops
        }
        $.ajax({
            type: 'POST',
            url: '/events/makeTour',
            data: {
                tour: tour,
                stops: stops
            }
        }).done(function(res) {
            console.log(res);
        })
    }

    function getStops() {
        $.ajax({
            type: 'GET',
            url: '/events/getStops',
        }).done(function(res) {
            makeStopDropdowns(res);
        })
    }

    function makeStopDropdowns(res) {
        let div = document.createElement("div");
        div.id = "stops";
        // make dropdown to select stops
        for (let index = 1; index <= tourStops; index++) {
            let label = document.createElement("label");
            label.htmlFor = index;

            let text = document.createTextNode("Stop " + index + ": ");
            label.appendChild(text);

            let select = document.createElement("select");
            select.id = index;

            for (const type of res) {
                var option = document.createElement('option');
                option.value = type.id;

                var description = document.createTextNode(type.name);
                option.appendChild(description);

                select.appendChild(option);
            }

            div.appendChild(label);
            div.appendChild(select);
        }

        container.appendChild(div);
    }

    function addRouteLocation() {
        if (shown == "") {
            shown = "addHL";
            add_location.remove();
            add_tour.remove();
        } else {
            container.innerHTML = "";
            add.remove();
            cancel.remove();
            addHisButtons();
            shown = "";
            return;
        }

        addDefInputs("Location")

        let butAdd = document.createElement('button');
        butAdd.innerHTML = "Add";
        butAdd.id = "add";
        butAdd.onclick = function() {
            addRouteLoc();
        };
        let butCan = document.createElement('button');
        butCan.innerHTML = "Cancel";
        butCan.id = "cancel";
        butCan.onclick = function() {
            addRouteLocation();
        };

        options.appendChild(butAdd);
        options.appendChild(butCan);
    }

    function foodEvent() {
        title.innerHTML = "Food event";
        addResButtons();
    }

    function addResButtons() {
        let addRes = document.createElement('button');
        addRes.innerHTML = "Add restaurant";
        addRes.id = "add_restaurant";
        addRes.onclick = function() {
            addRestaurant();
        };
        options.appendChild(addRes);
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

        let butAdd = document.createElement('button');
        butAdd.innerHTML = "Add";
        butAdd.id = "add";
        butAdd.onclick = function() {
            addRes();
        };
        let butCan = document.createElement('button');
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

    function getDefValues() {
        let values = {
            name: document.getElementById("name").value,
            description: document.getElementById("description").value,
            country: document.getElementById("country").value,
            city: document.getElementById("city").value,
            zipcode: document.getElementById("zipcode").value,
            address: document.getElementById("address").value
        };
        return values;
    }

    function addRes() {
        let values = getDefValues();

        $.ajax({
            type: 'POST',
            url: '/events/addRestaurant',
            data: {
                values
            }
        }).done(function(res) {
            alert(res);
            clearDefFields();
        })
    }

    function addRouteLoc() {
        let values = getDefValues();

        $.ajax({
            type: 'POST',
            url: '/events/addRouteLocation',
            data: {
                values
            }
        }).done(function(res) {
            alert(res);
            clearDefFields();
        })
    }

    function addJazzLoc() {
        let values = getDefValues();

        $.ajax({
            type: 'POST',
            url: '/events/addJazzLocation',
            data: {
                values
            }
        }).done(function(res) {
            alert(res);
            clearDefFields();
        })
    }
</script>