<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-earth-asia"></i>{{ $title }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home')}}"><i class="fa-solid fa-house me-"></i>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('table')}}"><i class="fa-solid fa-table me-1"></i>Table</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('map')}}"><i class="fa-solid fa-map-location-dot me-1"></i>Map</a>
                </li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-database me-1"></i> Data </a>
                    <ul class="dropdown-menu  dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{route('api.points')}}" target=" _blank">Points</a></li>
                        <li><a class="dropdown-item" href="{{route('api.polyline')}}" target=" _blank">Polyline</a></li>
                        <li><a class="dropdown-item" href="{{route('api.polygons')}}" target=" _blank">Polygon</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout')}}" method="POST" >
                        @csrf
                    <button class="nav-link text-danger" href="{{ route('map')}}"><i class="fa-solid fa-right-from-bracket me-1"></i> Logout</button>
                    </form>
                </li>
                @endauth

                @guest
                <li class="nav-item">
                    <a class="nav-link text-primary" href="{{ route('login')}}"><i class="fa-solid fa-right-from-bracket me-1"></i> Login</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
