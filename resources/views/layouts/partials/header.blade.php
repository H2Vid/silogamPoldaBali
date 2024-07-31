<nav class="navbar navbar-expand-xl navbar-fbt fbt-nav-skin fbt_sticky_nav">
    <div class="container nav-mobile-px clearfix">
        <div class="navbar-brand order-2 order-xl-1 m-auto">
            <a href="{{ url('/') }}"><img alt="Logo" src="{{ asset('assets/images/logo.png') }}" style="height: 120px;"></a>
        </div>
        <button aria-expanded="false" aria-label="Toggle navigation"
            class="navbar-toggler order-1 order-xl-2" data-target="#navbar-menu" data-toggle="collapse"
            type="button">☰</button>
        <div class="collapse navbar-collapse order-4 order-xl-3 clearfix" id="navbar-menu">
            <ul class="navbar-nav m-auto clearfix">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">Kategori</a>
                    <div class="dropdown-menu">
                        @foreach (Category::getAll() as $category)
                        <a href="{{ route('category', ['slug' => $category->slug]) }}" class="dropdown-item">{{ $category->title }}</a>
                        @endforeach
                    </div>
                </li>

                <li class="nav-item">
                    @if (Auth::guard('cms')->user())
                    <a href="{{ route('logout') }}" class="nav-link">Log Out ({{ Auth::guard('cms')->user()->name }})</a>
                    @else
                    <a href="{{ url('/') }}" data-toggle="modal" data-target="#login-modal" class="nav-link">Log In</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav><!-- .navbar end-->

<div class="modal fade" id="login-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login ke Akun Anda</h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('login') }}" method="post" class="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary my-3">Log In</button>
                </form>
            </div>
        </div>
    </div>
</div>