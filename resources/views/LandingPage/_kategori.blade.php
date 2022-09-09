<ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <a href="{{route('landing.home')}}" class="nav-link active">
            Home
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kategori
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            @foreach ($kategori as $k)
            <li>
                <a class="dropdown-item" href="{{route('landing.kategori', $k->category_slug)}}">{{$k->category_name}}</a>
            </li>
            @endforeach
        </ul>
    </li>
    <li class="nav-item">
        <a href="{{route('cekresi')}}" class="nav-link">
            Cek Resi Pesanan
        </a>
    </li>
    @auth    
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{ucfirst(Auth::user()->name)}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            @if (Auth::user()->role == 'admin')
            <li><a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a></li>
            @elseif (Auth::user()->role == 'user')
            <li><a class="dropdown-item" href="{{route('pesanan')}}">Data Pesanan</a></li>
            <li><a class="dropdown-item" href="{{route('profile.user')}}">Ubah Profile</a></li>
            @endif
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i
                        class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                        class="align-middle" data-key="t-logout">Logout</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </li>
    @endauth

    @guest    
    <li class="nav-item xl-none mt-3">
        <a href="{{route('login')}}" class="btn style1">Login</a>
    </li>
    @endguest
</ul>