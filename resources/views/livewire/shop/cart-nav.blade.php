<div class="d-flex justify-content-beetwen">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item {{ Request::is('/') ? 'active' :'' }}">
            <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{ Request::is('product') ? 'active' :'' }}">
            <a class="nav-link" href="{{ route('product') }}">Product</a>
        </li>
        <li class="nav-item {{ Request::is('shop*') ? 'active' :'' }}">
            <a class="nav-link" href="{{ route('shop') }}">Shop</a>
        </li>
        
        {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li> --}}
        <li class="nav-item @if ($cartTotal != 0) active @else @endif">
            <a class="nav-link" href="{{ route('cart') }}">Cart ({{$cartTotal}}) </a>
        </li>
    
    </ul>
</div>
