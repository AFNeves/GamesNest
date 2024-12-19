@if (!Auth::check())
    <div class="header-login space-x-4">
        <a href="{{ route('login') }}" class="custom-button header-button">Login</a>
        <a href="{{ route('register') }}" class="custom-button header-button register-button">Register</a>
    </div>
@else
    <div class="header-options space-x-5">
        @if (!Auth::user()->is_admin)
            <a href="{{ route('wishlist.show', ['id' => Auth::id()]) }}" class="center">
                <div class="header-icon icon-heart"></div>
            </a>

            <a href="{{ route('cart.show') }}" class="center">
                <div class="header-icon icon-cart"></div>
            </a>
        @endif

        <a href="{{ route('logout') }}" class="center">
            <div class="header-icon icon-logout"></div>
        </a>

        <a href="{{ route('profile.redirect') }}" class="center">
            <img src="{{ asset("/images/users/" . Auth::id() . "/" . Auth::user()->profile_picture) }}" alt="Profile" class="header-pic" />
        </a>
    </div>
@endif
