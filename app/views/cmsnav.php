<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
<link rel="stylesheet" href="/styles/cms.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark justify-content-between" id="topnavbar">
    <a class="navbar-brand" href="/cms">
        <img src="/assets/img/festivallogo.png" width="100" class="d-inline-block" alt="The Haarlem Festival Logo" />
        Haarlem<span style="color: #63b3ed">CMS</span>
    </a>
    <div class="justify-content-between">
        <?php if (isset($_SESSION['loggedin'])) : ?>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a href="/cms/signout" class="btn btn-outline-secondary me-3 px-3" role="button">Sign out</a>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</nav>
<!-- Navbar -->
<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand"><span id="sidetitle">Manage</span>
        </li>

        <li><a href="/cms">Dashboard</a>
        </li>
        <?php if (isset($_SESSION['loggedin'])) : ?>
            <li><a href="/cms/manage">Manage pages</a>
            </li>
            <li><a href="/cms/events">Events</a>
            </li>
            <li><a href="/cms/users">Users</a>
            </li>
            <li><a href="/cms/accountinfo">Account info</a>
            </li>
        <?php endif; ?>
        <hr style="width: 70%;">
        <li><a href="/">View site</a>
        </li>
    </ul>
</div>
<!-- Sidebar -->