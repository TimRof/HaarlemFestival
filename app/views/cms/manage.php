<h1><a href="/">The Haarlem Festival</a></h1>

<h3>CMS</h3>

<select name="event_types" id="event_types">
</select>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    document.onload = getEventTypes();

    function getEventTypes() {
        $.ajax({
            type: 'GET',
            url: '/cms/getEventTypes',
        }).done(function(res) {
            makeEventTypes(res);
        })
    }

    function makeEventTypes(res) {
        document.getElementById('event_types').innerHTML = "";
        for (const type of res) {
            var option = document.createElement('option');
            option.value = type.id;

            var description = document.createTextNode(type.name);
            option.appendChild(description);

            var select = document.getElementById('event_types');
            select.appendChild(option);
        }
    }
</script>