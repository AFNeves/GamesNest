@if (!Auth::check())
    <div class="flex items-center justify-between">
        <a href="{{ route('login') }}" class="header-button mr-8">Login</a>
        <a href="{{ route('register') }}" class="header-button">Register</a>
    </div>
@else
    <div class="flex items-center justify-between">
        <a href="{{ route('profile.show', ['id' => Auth::id()]) }}" class="py-2 mr-6">
            <img src="{{ asset("/images/users/" . Auth::id() . "/" . Auth::user()->profile_picture) }}" class="w-14 h-14 rounded-full" alt="User"/>
        </a>
        <a href="{{ route('wishlist.show', ['id' => Auth::id()]) }}" class="py-2 mr-6">
            <img src="{{ asset("/images/icons/open_heart.svg") }}" class="w-12 h-12" alt="Cart"/>
        </a>
        <a href="{{ route('cart.show', ['id' => Auth::id()]) }}" class="py-2 mr-6">
            <img src="{{ asset("/images/icons/cart.svg") }}" class="w-12 h-12" alt="Cart"/>
        </a>
        <a href="{{ route('logout') }}" class="py-2 mr-6">
            <img src="{{ asset("/images/icons/logout.svg") }}" class="w-12 h-12" alt="Logout"/>
        </a>
    </div>
@endif
