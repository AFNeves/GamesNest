<form method="POST" action="{{ route('search') }}" id="searchForm" class="search-form">
    @csrf

    <div class="search-div">
        <div class="search-bar">
            <input type="search" name="query" id="searchInput" class="search-input" placeholder="Search" required />

            <div id="searchClear" class="search-clear">
                <div class="search-clear-icon"></div>
            </div>
        </div>

        <div id="searchSubmit" class="search-submit">
            <div class="search-submit-icon"></div>
        </div>
    </div>
</form>
<button id="catMenuButton" class="p-2 text-white rounded  focus:outline-none">
    <img src="{{ asset("/images/icons/three_lines_menu.svg") }}" class="w-12 h-12" alt="Categories"/>
</button>

<!-- darker overlay for when the side menu is slided -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-60 z-40 hidden">
</div>

<!-- side menu with categories -->
<div id="sideMenu"
     class="fixed top-0 left-0 h-full w-64 bg-slate-600 shadow-lg z-50 transform -translate-x-full transition-transform duration-300 overflow-y-auto">
    <div class="p-4 border-b flex justify-between items-center">
        <h2 class="text-lg font-bold">Game Categories</h2>
        <button id="closeMenuButton" class="text-gray-500 hover:text-gray-700 focus:outline-none text-lg"> ✕
        </button>
    </div>
    @foreach(\App\Http\Controllers\CategoryController::getCategories() as $category)
        <ul class="p-4 space-y-5">
            <li><a href="{{ route('home', ['categories' => [$category->name]]) }}" class="text-blue-500 hover:underline">{{$category->name}}</li>
        </ul>
    @endforeach
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuButton = document.getElementById('catMenuButton');
        const sideMenu = document.getElementById('sideMenu');
        const overlay = document.getElementById('overlay');
        const closeMenuButton = document.getElementById('closeMenuButton');

        // open the sidebar
        menuButton.addEventListener('click', () => {
            sideMenu.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        // close the sidebar
        const closeMenu = () => {
            sideMenu.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        };

        //close the sidebar either on the X or the overlay
        closeMenuButton.addEventListener('click', closeMenu);
        overlay.addEventListener('click', closeMenu);
    });
</script>