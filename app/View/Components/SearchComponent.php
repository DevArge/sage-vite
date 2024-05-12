<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Vite;

class SearchComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
        // $a = Vite::asset('resources/styles/components/_search.scss');
        // dd($a);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-component');
    }
}
