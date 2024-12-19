<form method="POST" action="{{ route('search') }}" class="flex-grow mx-8 max-w-[calc(55%)]">
    @csrf

    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="search" name="query"
               class="block w-full p-4 ps-11 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="Search" required/>
        <button type="submit"
                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Search
        </button>
    </div>
</form>

<!-- categories menu button -->
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
            <li><a href="" class="text-blue-500 hover:underline">{{$category->name}}</li>
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
