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

    // act info
    var actName = "";
    var actMembers = 1;
    var actDesc = "";
    var actLoc = "";

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
        addJazzButtons();
    }

    function addJazzButtons() {
        let addloc = document.createElement('button');
        addloc.innerHTML = "Add venue";
        addloc.id = "add_location";
        addloc.onclick = function() {
            addJazzVenue();
        };
        let addact = document.createElement('button');
        addact.innerHTML = "Add act";
        addact.id = "add_act";
        addact.onclick = function() {
            addAct();
        };
        options.appendChild(addloc);
        options.appendChild(addact);
    }

    // add act for jazz
    function addAct() {
        // reset act info
        actMembers = 1;
        actName = "";
        if (shown == "") {
            shown = "addJA";
            add_act.remove();
            add_location.remove();
        } else {
            container.innerHTML = "";
            if ($('#next').length > 0) {
                next.remove();
            }
            if ($('#back').length > 0) {
                back.remove();
            }
            cancel.remove();
            addJazzButtons();
            shown = "";
            return;
        }

        // cancel button
        let butCan = document.createElement('button');
        butCan.innerHTML = "Cancel";
        butCan.id = "cancel";
        butCan.onclick = function() {
            addAct();
        };

        options.appendChild(butCan);

        addActName();
    }

    function addActName() {
        // check if back or new
        if ($('#back').length > 0) {
            container.innerHTML = "";
            back.remove();
            add.remove();
            let butCan = document.createElement('button');
            butCan.innerHTML = "Cancel";
            butCan.id = "cancel";
            butCan.onclick = function() {
                addAct();
            };
            options.appendChild(butCan);
        }
        // next button
        let butNext = document.createElement('button');
        butNext.innerHTML = "Next";
        butNext.id = "next";
        butNext.onclick = function() {
            addActInfo();
        };

        options.appendChild(butNext);

        // act name input
        let nameLabel = document.createElement("label");
        nameLabel.htmlFor = "name";
        let nameText = document.createTextNode("Act name*: ");
        nameLabel.appendChild(nameText);

        let nameInput = document.createElement("input");
        nameInput.id = "name";
        nameInput.value = actName;
        nameInput.placeholder = "Name";

        container.appendChild(nameLabel);
        container.appendChild(nameInput);
        // act description input
        let descLabel = document.createElement("label");
        descLabel.htmlFor = "description";
        let descText = document.createTextNode("Act description: ");
        descLabel.appendChild(descText);

        let descInput = document.createElement("input");
        descInput.id = "description";
        descInput.value = actDesc;
        descInput.placeholder = "Description";

        container.appendChild(descLabel);
        container.appendChild(descInput);
        // act location input
        let locLabel = document.createElement("label");
        locLabel.htmlFor = "location";
        let locText = document.createTextNode("Act location: ");
        locLabel.appendChild(locText);

        let locInput = document.createElement("input");
        locInput.id = "location";
        locInput.value = actLoc;
        locInput.placeholder = "Specified location";

        container.appendChild(locLabel);
        container.appendChild(locInput);

        // act members amount
        let membersLabel = document.createElement("label");
        membersLabel.htmlFor = "stops";
        let membersText = document.createTextNode("Number of members (min 1, max 20): ");
        membersLabel.appendChild(membersText);

        let membersInput = document.createElement("input");
        membersInput.type = "number";
        membersInput.id = "members";
        membersInput.min = "1";
        membersInput.max = "20";
        membersInput.value = actMembers;
        membersInput.placeholder = "Number of members";

        container.appendChild(membersLabel);
        container.appendChild(membersInput);
    }

    function addActInfo() {
        let nameInput = document.getElementById("name");
        let membersInput = document.getElementById("members");
        if (nameInput.value != "") {
            if (membersInput.value > 0 && membersInput.value < 21) {
                actName = nameInput.value;
                actMembers = membersInput.value;
                container.innerHTML = "";
                cancel.remove();
                next.remove();

                let butBac = document.createElement('button');
                butBac.innerHTML = "Back";
                butBac.id = "back";
                butBac.onclick = function() {
                    addActName();
                };
                let butAdd = document.createElement('button');
                butAdd.innerHTML = "Add Act";
                butAdd.id = "add";
                butAdd.onclick = function() {
                    let inputs = document.getElementById('members').getElementsByTagName('input');
                    let members = [];
                    for (let index = 0; index < inputs.length; index++) {
                        let act_member = {
                            name: inputs[index].value
                        }
                        members.push(act_member);
                    }
                    makeAct(members);
                };
                options.appendChild(butBac);
                options.appendChild(butAdd);

                makeMemberInputs();
            } else {
                alert("An act should have between 1 and 20 members!");
            }
        } else {
            alert("Name can not be empty!");
        }
    }

    function makeAct(members) {
        let act = {
            name: actName,
            description: actDesc,
            location: actLoc
        }
        $.ajax({
            type: 'POST',
            url: '/events/makeAct',
            data: {
                act: act,
                members: members
            }
        }).done(function(res) {
            alert(res);
            actName = "";
            actMembers = 1;
            actDesc = "";
            actLoc = "";
            addActName();
        })
    }

    function makeMemberInputs() {
        let div = document.createElement("div");
        div.id = "members";
        // make inputs for member names
        for (let index = 1; index <= actMembers; index++) {
            let label = document.createElement("label");
            label.htmlFor = index;

            let text = document.createTextNode("Member " + index + ": ");
            label.appendChild(text);

            let input = document.createElement("input");
            input.id = index;
            input.placeholder = "Name";

            div.appendChild(label);
            div.appendChild(input);
        }

        container.appendChild(div);
    }

    // add venue for jazz
    function addJazzVenue() {
        if (shown == "") {
            shown = "addJV";
            add_location.remove();
            add_act.remove();
        } else {
            container.innerHTML = "";
            add.remove();
            cancel.remove();
            addJazzButtons();
            shown = "";
            return;
        }

        addDefInputs("Venue")

        // add button
        let butAdd = document.createElement('button');
        butAdd.innerHTML = "Add";
        butAdd.id = "add";
        butAdd.onclick = function() {
            makeJazzVenue();
        };
        // cancel button
        let butCan = document.createElement('button');
        butCan.innerHTML = "Cancel";
        butCan.id = "cancel";
        butCan.onclick = function() {
            addJazzVenue();
        };

        options.appendChild(butCan);
        options.appendChild(butAdd);
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
        // next button
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
                    tourStops = stopsInput.value;
                    tourName = nameInput.value;
                    tourLang = langInput.value;
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
                            let tour_stop = {
                                stop_number: inputs[index].id,
                                tour_location_id: inputs[index].value
                            }
                            stops.push(tour_stop);
                        }
                        makeTour(stops);
                    };
                    options.appendChild(butBac);
                    options.appendChild(butAdd);

                    getStops();
                } else {
                    alert("A tour can not have more than 20 stops!")
                }
            } else {
                alert("A tour should have atleast 3 stops!")
            }
        } else {
            alert("Name and language can not be empty!");
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
            alert(res);
            tourName = "";
            tourLang = "";
            stops = 3;
            tourInfo();
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
            makeRouteLoc();
        };
        let butCan = document.createElement('button');
        butCan.innerHTML = "Cancel";
        butCan.id = "cancel";
        butCan.onclick = function() {
            addRouteLocation();
        };

        options.appendChild(butCan);
        options.appendChild(butAdd);
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
            makeRestaurant();
        };
        let butCan = document.createElement('button');
        butCan.innerHTML = "Cancel";
        butCan.id = "cancel";
        butCan.onclick = function() {
            addRestaurant();
        };

        options.appendChild(butCan);
        options.appendChild(butAdd);
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

    function makeRestaurant() {
        let values = getDefValues();

        $.ajax({
            type: 'POST',
            url: '/events/makeRestaurant',
            data: {
                values
            }
        }).done(function(res) {
            alert(res);
            clearDefFields();
        })
    }

    function makeRouteLoc() {
        let values = getDefValues();

        $.ajax({
            type: 'POST',
            url: '/events/makeRouteLocation',
            data: {
                values
            }
        }).done(function(res) {
            alert(res);
            clearDefFields();
        })
    }

    function makeJazzVenue() {
        let values = getDefValues();

        $.ajax({
            type: 'POST',
            url: '/events/makeJazzVenue',
            data: {
                values
            }
        }).done(function(res) {
            alert(res);
            clearDefFields();
        })
    }
</script>