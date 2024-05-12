<header class="top-bar bg-[rgb(0_12_25)] p-[19px_56px]">
    <div class="top-bar-container flex items-center max-w-[1920px] justify-between m-auto">
        <div class="top-bar-left-side flex">

            @if (has_nav_menu('primary_navigation'))
                <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
                    {!! wp_nav_menu([
                        'menu_id'           => 'main-menu',
                        'theme_location' => 'primary_navigation',
                        'menu_class'        => 'flex flex-row items-center justify-start text-base font-roboto text-slate-900 cursor-col-resize p-0',
                        'container_class'   => 'flex-row items-center justify-around overflow-x-auto font-semibold scrollbar-hide md:overflow-x-visible',
                        'li_class'          => 'relative w-auto px-1 pt-1 pb-1 flex items-center justify-center cursor-pointer md:px-4 md:py-5 ',
                        'active'            => 'relative w-auto px-1 pt-1 pb-1 flex items-center justify-center cursor-pointer md:px-4 md:py-5 bg-slate-100',
                    ]) !!}
                </nav>
            @endif
        </div>
        <div class="top-bar-right-side">
            <x-search-component></x-search-component>
        </div>

    </div>
</header>
