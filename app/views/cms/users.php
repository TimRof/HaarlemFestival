<h1><a href="/">The Haarlem Festival</a></h1>

<h3>CMS</h3>
<a href="/cms/adduser">add user</a>

<ul id="users_list"></ul>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    document.onload = getUsers();

    function getUsers() {
        $.ajax({
            type: 'GET',
            url: '/cms/getUsers',
        }).done(function(res) {
            console.log(res);
            makeUserLi(res);
        })
    }

    function makeUserLi(res) {
        document.getElementById('users_list').innerHTML = "";
        var ul = document.getElementById('users_list');

        for (const user of res) {
            var li = document.createElement('li');
            li.value = user.id;

            var liDescr = document.createTextNode(user.id + ": " + user.first_name + " " + user.last_name + " - " + user.email);
            li.appendChild(liDescr);


            ul.appendChild(li);
        }
    }
</script>