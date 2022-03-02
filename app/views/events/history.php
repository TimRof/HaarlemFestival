<h1><a href="/">The Haarlem Festival</a></h1>

<h3 id="title"></h3>
<p id="description"></p>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    document.onload = getContent();

    function getContent() {

        $.ajax({
            type: 'GET',
            url: '/cms/getEventOverview',
            data: {
                id: 2
            }
        }).done(function(res) {
            console.log(res);
            fillPage(res);
        })
    }

    function fillPage(res) {
        var t = document.createTextNode(res.title);
        var title = document.getElementById('title');
        title.appendChild(t);

        var d = document.createTextNode(res.description);
        var description = document.getElementById('description');
        description.appendChild(d);
    }
</script>