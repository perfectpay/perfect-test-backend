<nav class="navbar bg-gradient-primary" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="" href="{{ url('/') }}">Teste Back End</a>
        <!-- User -->
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a id="bell" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    <span id="bell-number" class="badge badge-danger badge-pill"></span>
                </a>
                <div id='notifications' class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbar-default_dropdown_1">
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class='d-md-down-none'>Albert Einsten</span>
                    <img class='rounded-pill' src='{{ url("/img/destaque-albert-einstein.jpg") }}' width='40' height='40' alt='Albert Einsten'>
                </a>
                <div class="dropdown-menu dropdown-menu-right position-absolute">
                    <div class="dropdown-header">
                        <h6 class="text-overflow m-0">Bem vindo(a)!</h6>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
