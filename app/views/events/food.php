<h1><a href="/">The Haarlem Festival</a></h1>

<h3 id="title"></h3>
<img id="image" src="" alt="Food Overview Image" style="border-radius: 100%;
              height: 250px;
              width: 250px;
              background: #ccc;
              margin: 20px;
              box-shadow: rgba(0, 0, 0, 0.15) 0px 3px 3px 0px;">
<div id="description"></div>

<a href="/purchase?filter=food">
    <h2>GET YOUR TICKETS NOW</h2>
</a>

<!-- foreach with tickets -->

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    document.onload = getContent();

    function getContent() {

        $.ajax({
            type: 'GET',
            url: '/events/getEventOverview',
            data: {
                id: 1
            }
        }).done(function(res) {
            fillPage(res);
        })
    }

    function fillPage(res) {
        var t = document.createTextNode(res.title);
        var title = document.getElementById('title');
        title.appendChild(t);

        var description = document.getElementById('description');
        description.innerHTML = res.description;

        var image = document.getElementById('image');
        image.src = res.image;
    }
</script>