@if (!Auth::check())
    <div class="flex items-center justify-between">
        <a href="{{ route('login') }}" class="header-button mr-8">Login</a>
        <a href="{{ route('register') }}" class="header-button">Get started</a>
    </div>
@else
    <div class="flex items-center justify-between">
        <a href="{{ route('profile', ['id' => Auth::id()]) }}" class="py-2 mr-6">
            <img src="{{ asset('images/' . Auth::user()->profile_picture) }}" class="w-14 h-14 rounded-full" alt="User"/>
        </a>
        <a href="{{ route('logout') }}" class="header-button">Logout</a>
    </div>
@endif
