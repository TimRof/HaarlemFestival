<h1><a href="/">The Haarlem Festival</a></h1>

<h3>CMS</h3>
<div>
    <h2 id="title"></h2>
</div>
<div id="main">
</div>

<style>
.btn{
    margin-right: 5px;
    margin-bottom: 10px;
}</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
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
        foodB.classList.add("btn");
        foodB.classList.add("btn-primary");

        foodB.onclick = function() {
            eventChosen(this.value)
        };
        main.appendChild(foodB);

        let histB = document.createElement('button');
        histB.innerHTML = "History";
        histB.value = "History";
        histB.classList.add("btn");
        histB.classList.add("btn-primary");
        histB.onclick = function() {
            eventChosen(this.value)
        };
        main.appendChild(histB);

        let jazzB = document.createElement('button');
        jazzB.innerHTML = "Jazz";
        jazzB.value = "Jazz";
        jazzB.classList.add("btn");
        jazzB.classList.add("btn-primary");
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
        backBut.classList.add("btn");
        backBut.classList.add("btn-secondary");
        backBut.onclick = function() {
            startButtons();
        };
        options.appendChild(backBut);
        main.insertBefore(options, main.firstChild);
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
        let div = document.createElement("div");
        div.id = "inputs";
        let nameInput = document.createElement('input');
        nameInput.placeholder = $str + " name";
        nameInput.id = "name";
        nameInput.required = "name";
        nameInput.classList.add("form-control");
        let desInput = document.createElement('input');
        desInput.placeholder = "Description";
        desInput.id = "description";
        desInput.classList.add("form-control");
        let couInput = document.createElement('input');
        couInput.placeholder = "Country";
        couInput.id = "country";
        couInput.value = "Netherlands";
        couInput.classList.add("form-control");
        let citInput = document.createElement('input');
        citInput.placeholder = "City";
        citInput.id = "city";
        citInput.value = "Haarlem";
        citInput.classList.add("form-control");
        let zipInput = document.createElement('input');
        zipInput.placeholder = "Zipcode";
        zipInput.id = "zipcode";
        zipInput.classList.add("form-control");
        let adInput = document.createElement('input');
        adInput.placeholder = "Address";
        adInput.id = "address";
        adInput.classList.add("form-control");

        div.appendChild(nameInput);
        div.appendChild(desInput);
        div.appendChild(couInput);
        div.appendChild(citInput);
        div.appendChild(zipInput);
        div.appendChild(adInput);
        options.appendChild(div);
    }

    function jazzEvent() {
        title.innerHTML = "Jazz event";
        jazzOverview();
        addJazzButtons();
    }

    function jazzOverview() {
        venuesOverview();
        actsOverview();
    }

    function venuesOverview() {
        $.ajax({
            type: 'GET',
            url: '/events/getVenues',
        }).done(function(res) {
            makeTable(res, "Venues");
        })
    }

    function actsOverview() {
        $.ajax({
            type: 'GET',
            url: '/events/getActs',
        }).done(function(res) {
            makeTable(res, "Acts");
        })
    }

    function addJazzButtons() {
        let addloc = document.createElement('button');
        addloc.innerHTML = "Add venue";
        addloc.id = "add_location";
        addloc.classList.add("btn");
        addloc.classList.add("btn-primary");
        addloc.onclick = function() {
            addJazzVenue();
        };
        let addact = document.createElement('button');
        addact.innerHTML = "Add act";
        addact.id = "add_act";
        addact.classList.add("btn");
        addact.classList.add("btn-primary");
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
            document.getElementById("inputs").remove();
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
        butCan.classList.add("btn");
        butCan.classList.add("btn-danger");
        butCan.onclick = function() {
            addAct();
        };

        options.appendChild(butCan);

        addActName();
    }

    function addActName() {
        // check if back or new
        if ($('#back').length > 0) {
            document.getElementById("members").remove();
            back.remove();
            add.remove();
            let butCan = document.createElement('button');
            butCan.innerHTML = "Cancel";
            butCan.id = "cancel";
            butCan.classList.add("btn");
            butCan.classList.add("btn-danger");
            butCan.onclick = function() {
                addAct();
            };
            options.appendChild(butCan);
        }
        let div = document.createElement("div");
        div.id = "inputs";
        // next button
        let butNext = document.createElement('button');
        butNext.innerHTML = "Next";
        butNext.id = "next";
        butNext.classList.add("btn");
        butNext.classList.add("btn-primary");
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
        nameInput.classList.add("form-control");

        div.appendChild(nameLabel);
        div.appendChild(nameInput);
        // act description input
        let descLabel = document.createElement("label");
        descLabel.htmlFor = "description";
        let descText = document.createTextNode("Act description: ");
        descLabel.appendChild(descText);

        let descInput = document.createElement("input");
        descInput.id = "description";
        descInput.value = actDesc;
        descInput.placeholder = "Description";
        descInput.classList.add("form-control");

        div.appendChild(descLabel);
        div.appendChild(descInput);
        // act location input
        let locLabel = document.createElement("label");
        locLabel.htmlFor = "location";
        let locText = document.createTextNode("Act location: ");
        locLabel.appendChild(locText);

        let locInput = document.createElement("input");
        locInput.id = "location";
        locInput.value = actLoc;
        locInput.placeholder = "Specified location";
        locInput.classList.add("form-control");

        div.appendChild(locLabel);
        div.appendChild(locInput);

        // act members amount
        let membersLabel = document.createElement("label");
        membersLabel.htmlFor = "stops";
        let membersText = document.createTextNode("Number of members (min 1, max 8): ");
        membersLabel.appendChild(membersText);

        let membersInput = document.createElement("input");
        membersInput.type = "number";
        membersInput.id = "members";
        membersInput.min = "1";
        membersInput.max = "8";
        membersInput.value = actMembers;
        membersInput.placeholder = "Number of members";
        membersInput.classList.add("form-control");

        div.appendChild(membersLabel);
        div.appendChild(membersInput);

        options.appendChild(div);
    }

    function addActInfo() {
        let nameInput = document.getElementById("name");
        let descInput = document.getElementById("description");
        let locInput = document.getElementById("location");
        let membersInput = document.getElementById("members");
        if (nameInput.value != "") {
            if (membersInput.value > 0 && membersInput.value < 9) {
                actName = nameInput.value;
                actDesc = descInput.value;
                actLoc = locInput.value;
                actMembers = membersInput.value;
                document.getElementById("inputs").remove();
                cancel.remove();
                next.remove();

                let butBac = document.createElement('button');
                butBac.innerHTML = "Back";
                butBac.id = "back";
                butBac.classList.add("btn");
                butBac.classList.add("btn-warning");
                butBac.onclick = function() {
                    addActName();
                };
                let butAdd = document.createElement('button');
                butAdd.innerHTML = "Add Act";
                butAdd.id = "add";
                butAdd.classList.add("btn");
                butAdd.classList.add("btn-success");
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
                alert("An act should have between 1 and 8 members!");
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
            jazzOverview();
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
            input.classList.add("form-control");

            div.appendChild(label);
            div.appendChild(input);
        }

        options.appendChild(div);
    }

    // add venue for jazz
    function addJazzVenue() {
        if (shown == "") {
            shown = "addJV";
            add_location.remove();
            add_act.remove();
        } else {
            document.getElementById("inputs").remove();
            add.remove();
            cancel.remove();
            addJazzButtons();
            shown = "";
            return;
        }

        // add button
        let butAdd = document.createElement('button');
        butAdd.innerHTML = "Add";
        butAdd.id = "add";
        butAdd.classList.add("btn");
        butAdd.classList.add("btn-success");
        butAdd.onclick = function() {
            makeJazzVenue();
        };
        // cancel button
        let butCan = document.createElement('button');
        butCan.innerHTML = "Cancel";
        butCan.id = "cancel";
        butCan.classList.add("btn");
        butCan.classList.add("btn-danger");
        butCan.onclick = function() {
            addJazzVenue();
        };

        options.appendChild(butCan);
        options.appendChild(butAdd);
        addDefInputs("Venue");
    }

    function historyEvent() {
        title.innerHTML = "History event";
        historyOverview();
        addHisButtons();
    }

    function historyOverview() {
        locationsOverview();
        toursOverview();
    }

    function locationsOverview() {
        $.ajax({
            type: 'GET',
            url: '/events/getStops',
        }).done(function(res) {
            makeTable(res, "Locations");
        })
    }

    function toursOverview() {
        $.ajax({
            type: 'GET',
            url: '/events/getTours',
        }).done(function(res) {
            makeTable(res, "Tours");
        })
    }

    function addHisButtons() {
        let addLoc = document.createElement('button');
        addLoc.innerHTML = "Add location";
        addLoc.id = "add_location";
        addLoc.classList.add("btn");
        addLoc.classList.add("btn-primary");
        addLoc.onclick = function() {
            addRouteLocation();
        };
        options.appendChild(addLoc);

        let addTou = document.createElement('button');
        addTou.innerHTML = "Add tour";
        addTou.id = "add_tour";
        addTou.classList.add("btn");
        addTou.classList.add("btn-primary");
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
            document.getElementById("inputs").remove();
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
        butCan.classList.add("btn");
        butCan.classList.add("btn-danger");
        butCan.onclick = function() {
            addTour();
        };
        options.appendChild(butCan);

        tourInfo();
    }

    function tourInfo() {
        // check if back or new
        if ($('#back').length > 0) {
            document.getElementById("stops").remove();
            back.remove();
            add.remove();
            let butCan = document.createElement('button');
            butCan.innerHTML = "Cancel";
            butCan.id = "cancel";
            butCan.classList.add("btn");
            butCan.classList.add("btn-danger");
            butCan.onclick = function() {
                addTour();
            };
            options.appendChild(butCan);
        }
        let div = document.createElement('div');
        div.id = "inputs";
        // next button
        let butNext = document.createElement('button');
        butNext.innerHTML = "Next";
        butNext.id = "next";
        butNext.classList.add("btn");
        butNext.classList.add("btn-primary");
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
        nameInput.classList.add("form-control");

        // language input
        let langLabel = document.createElement("label");
        langLabel.htmlFor = "language";
        let langText = document.createTextNode("Tour language: ");
        langLabel.appendChild(langText);

        let langInput = document.createElement('input');
        langInput.placeholder = "Tour language";
        langInput.value = tourLang;
        langInput.id = "language";
        langInput.classList.add("form-control");

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
        stopsInput.classList.add("form-control");

        div.appendChild(nameLabel);
        div.appendChild(nameInput);
        div.appendChild(langLabel);
        div.appendChild(langInput);
        div.appendChild(stopsLabel);
        div.appendChild(stopsInput);
        options.appendChild(div);
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
                    document.getElementById("inputs").remove();
                    cancel.remove();
                    next.remove();

                    let butBac = document.createElement('button');
                    butBac.innerHTML = "Back";
                    butBac.id = "back";
                    butBac.classList.add("btn");
                    butBac.classList.add("btn-warning");
                    butBac.onclick = function() {
                        tourInfo();
                    };
                    let butAdd = document.createElement('button');
                    butAdd.innerHTML = "Add Tour";
                    butAdd.id = "add";
                    butAdd.classList.add("btn");
                    butAdd.classList.add("btn-success");
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
            historyOverview();
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
            select.classList.add("form-control");

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

        options.appendChild(div);
    }

    function addRouteLocation() {
        if (shown == "") {
            shown = "addHL";
            add_location.remove();
            add_tour.remove();
        } else {
            document.getElementById("inputs").remove();
            add.remove();
            cancel.remove();
            addHisButtons();
            shown = "";
            return;
        }

        let butAdd = document.createElement('button');
        butAdd.innerHTML = "Add";
        butAdd.id = "add";
        butAdd.classList.add("btn");
        butAdd.classList.add("btn-success");
        butAdd.onclick = function() {
            makeRouteLoc();
        };
        let butCan = document.createElement('button');
        butCan.innerHTML = "Cancel";
        butCan.id = "cancel";
        butCan.classList.add("btn");
        butCan.classList.add("btn-danger");
        butCan.onclick = function() {
            addRouteLocation();
        };

        options.appendChild(butCan);
        options.appendChild(butAdd);
        addDefInputs("Location");
    }

    function foodEvent() {
        title.innerHTML = "Food event";
        foodOverview();
        addResButtons();
    }

    function foodOverview() {
        restaurantOverview();
    }

    function restaurantOverview() {
        $.ajax({
            type: 'GET',
            url: '/events/getRestaurants',
        }).done(function(res) {
            makeTable(res, "Restaurants");
        })
    }

    function makeTable(res, string) {
        // make title
        let title = document.createElement("h3");
        let titleText = document.createTextNode(string);
        title.appendChild(titleText);
        title.id = "T" + string;
        // reset if tables already present
        if ($('#' + string).length > 0) {
            document.getElementById(string).remove();
            document.getElementById("T" + string).remove();
        }
        let table = document.createElement("table");
        table.id = string;
        table.classList.add("table");
        table.classList.add("table-striped");
        var thead = document.createElement('thead');
        thead.classList.add("thead-dark");
        // make headers
        table.appendChild(thead);
        for (let k in res[0]) {
            thead.appendChild(document.createElement("th")).
            appendChild(document.createTextNode(k.charAt(0).toUpperCase() + k.slice(1)));
        }

        container.appendChild(title);
        container.appendChild(table);
        // fill data
        res.forEach(element => {
            let i = 0;
            let row = table.insertRow();
            for (var k in element) {
                let cell = row.insertCell(i);
                cell.innerHTML = element[k];
                i++;
            }
        });
    }

    function addResButtons() {
        let addRes = document.createElement('button');
        addRes.innerHTML = "Add restaurant";
        addRes.id = "add_restaurant";
        addRes.classList.add("btn");
        addRes.classList.add("btn-primary");
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
            document.getElementById("inputs").remove();
            add.remove();
            cancel.remove();
            addResButtons();
            shown = "";
            return;
        }

        let butAdd = document.createElement('button');
        butAdd.innerHTML = "Add";
        butAdd.id = "add";
        butAdd.classList.add("btn");
        butAdd.classList.add("btn-success");
        butAdd.onclick = function() {
            makeRestaurant();
        };
        let butCan = document.createElement('button');
        butCan.innerHTML = "Cancel";
        butCan.id = "cancel";
        butCan.classList.add("btn");
        butCan.classList.add("btn-danger");
        butCan.onclick = function() {
            addRestaurant();
        };

        options.appendChild(butCan);
        options.appendChild(butAdd);
        addDefInputs("Restaurant");
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
            foodOverview();
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
            historyOverview();
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
            jazzOverview();
        })
    }
</script>