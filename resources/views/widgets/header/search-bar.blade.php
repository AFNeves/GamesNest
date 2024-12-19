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
