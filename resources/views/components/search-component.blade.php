<form role="search" method="get" id="search-form" class="search-form relative" action="{{ esc_url( home_url( '/' ) ) }}">

    <input
        id="search-input"
        class="bg-gray-900 w-[260px] p-[10px_40px_10px_15px] rounded-[8px] border-gray-700 border outline-1 font-roboto text-slate-300 text-[14px] leading-1"
        type="text"
        name="s"
        placeholder="Search..."
        aria-label="search input"
        value="{{ esc_attr( get_search_query() )}}"
    >

    <button class="absolute right-0 -translate-y-2/4 top-2/4 indent-[-999px] overflow-hidden w-10 bg-center bg-no-repeat m-0 p-0 cursor-pointer" type="submit" >
        Search
    </button>

</form>
