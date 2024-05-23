<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <!-- <span class="navbar-brand">Dashboard {{ isset($title) ? '/ ' . $title : '' }}<div class="ripple-container"></div></span> -->
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">

            <ul class="navbar-nav">


                <li class="nav-item dropdown">
                    <a href="#" class="btn btn-xs btn-danger" style="padding: 3px 7px 3px 7px;"
                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        Logout
                    </a>
                </li>
                <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
        <a class="dropdown-item" href="/page-user.html">Profile</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="/logout">Log out</a>
        </div>
        </li>
        </ul>
        </div> -->
        </div>
</nav>
