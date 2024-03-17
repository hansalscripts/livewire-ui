<?php

namespace HansalScripts\LivewireUi\LaravelLivewireLoader\Components;

use Livewire\Component;

class Loader extends Component
{
    public function render()
    {
        return view('laravel-livewire-loader::loader');
    }
}
