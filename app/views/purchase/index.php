<h1><a href="/">The Haarlem Festival</a></h1>

<h3>Purchase</h3>
<ul>
    <li><a onclick="foodEvent()">Food</a></li>
    <li><a onclick="historyEvent()">History</a></li>
    <li><a onclick="jazzEvent()">Jazz</a></li>
</ul>
<div id="type"></div>
<script>
    document.onload = start();

    function start() {
        let filter = new URLSearchParams(window.location.search).get("filter");

        if (filter) {
            switch (filter.toLocaleLowerCase()) {
                case "food":
                    foodEvent();
                    break;
                case "history":
                    historyEvent();
                    break;
                case "jazz":
                    jazzEvent();
                    break;

                default:
                    foodEvent();
                    break;
            }

        } else {
            foodEvent();
        }
    }

    function foodEvent() {
        document.getElementById("type").innerHTML = "Showing Food event items";
    }

    function historyEvent() {
        document.getElementById("type").innerHTML = "Showing History event items";
    }

    function jazzEvent() {
        document.getElementById("type").innerHTML = "Showing Jazz event items";
    }

    function showAll() {
        document.getElementById("type").innerHTML = "Showing all";
    }
</script>