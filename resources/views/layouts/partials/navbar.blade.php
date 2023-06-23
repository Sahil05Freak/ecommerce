<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
          <use xlink:href="#bootstrap" />
        </svg>
      </a>
      <?php

      use Illuminate\Support\Facades\DB;
      use Illuminate\Support\Facades\Auth;

      if (Auth::check()) {
        $user = Auth::user();
        $role = DB::table('role_user')->where('user_id', $user->id)->first();
      }
      ?>
      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        @guest
        <li><a href="{{ route('home.index') }}" class="nav-link px-2 text-white">Home</a></li>
        @endguest
        @auth
        <li><a href="{{ route('home.index') }}" class="nav-link px-2 text-white">Home</a></li>
        @if($role)
        @if($role->role_id == 2)
        <li><a href="{{ route('products') }}" class="nav-link px-2 text-white">Products</a></li>
        @elseif($role->role_id == 3)
        <li><a href="{{ route('productList') }}" class="nav-link px-2 text-white">Product List</a></li>
        <li><a href="{{ route('carts') }}" class="nav-link px-2 text-white">Carts</a></li>
        @endif
        @endif
        @endauth
      </ul>

      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
      </form>

      @auth
      <div class="text-end">
        <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
      </div>
      @endauth

      @guest
      <div class="text-end">
        <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
        <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
      </div>
      @endguest
    </div>
  </div>
</header>