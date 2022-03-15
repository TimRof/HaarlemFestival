<head>
    <link rel="stylesheet" href="../style/purchase.css">
</head>

<h1><a href="/">The Haarlem Festival</a></h1>

<h3>Purchase</h3>
<content>
    <div id="filter_container">
        <div class="event_filter" id="event_search">
            SEARCH
            <p><input type="text" name="search" placeholder="Search events, type..."></p>
        </div>
        <div class="event_filter" id="event_type">
            EVENT TYPES
        </div>
        <div class="event_filter" id="event_date">
            DATE
        </div>
        <div class="event_filter" id="event_price">
            PRICE
        </div>
        <div class="event_filter" id="event_options">
            OPTIONS
        </div>
    </div>
    <div id="event_list">
        <div class="event_style" id="event_item">
            <p>event item</p>
        </div>
    </div>
</content>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    document.onload = getEvents();

    function getEvents() {
        console.log("getEvents active");
        $.ajax({
            type: 'GET',
            url: '/events/getAllEvents',
        }).done(function(res) {
            makeEvents(res);
        })
    }

    function makeEvents(res) {
        console.log("makeEvents active");
        for (let i = 0; i < res.length; i++) {
            event = document.createElement('div');
            event.setAttribute('class', 'event_style');

            title = document.createElement('h1');
            title.appendChild(document.createTextNode(res[i].name));
            
            capacity = document.createElement('p');
            capacity.appendChild(document.createTextNode(res[i].capacity));

            date = document.createElement('p');
            date.appendChild(document.createTextNode(res[i].date));

            price = document.createElement('p');
            price.appendChild(document.createTextNode(res[i].price));

            content = document.createElement('p');
            content.appendChild(document.createTextNode(res[i].content));

            createdDate = document.createElement('p');
            createdDate.appendChild(document.createTextNode(res[i].created_at));

            buyButton = document.createElement('button');
            buyButton.innerText = "Add";
            buyButton.addEventListener('click', () => {
                alert(res[i].name + " will be added to card");
            })

            event.appendChild(title);
            event.appendChild(capacity);
            event.appendChild(date);
            event.appendChild(price);
            event.appendChild(content);
            event.appendChild(createdDate);
            event.appendChild(buyButton);

            document.getElementById("event_list").appendChild(event);
        }
        
        console.log(res);

    }
</script>