<?php

namespace HansalScripts\LivewireUi\LaravelLivewireToasts\Components;

use Livewire\Component;

class Toasts extends Component
{
    public $color;
    public $message;

    protected $listeners = ['showToast'];

    public function render()
    {
        return view('laravel-livewire-toasts::toasts');
    }

    public function showToast($color, $message)
    {
        $this->color = $color;
        $this->message = $message;

        $this->emit('showBootstrapToast');
    }
}
