<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

Route::middleware('web')->group(function () {
    $livewireNamespace = config('livewire.class_namespace');
    $path = base_path(str_replace('\\', DIRECTORY_SEPARATOR , $livewireNamespace));

    $namespace = app()->getNamespace();

    if (!is_dir($path)) {
        return;
    }

    foreach ((new Finder)->in($path) as $component) {
        $component = $namespace . str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($component->getRealPath(), realpath(app_path()) . DIRECTORY_SEPARATOR)
            );

        if (method_exists($component, 'route')) {
            app($component)->route()->uses($component);
        }
    }

});
