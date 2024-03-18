<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

Route::middleware('web')->group(function () {
    $livewireNamespace = config('livewire.class_namespace');
    $livewirePath = base_path('app/' . str_replace('\\', '/', $livewireNamespace));

    if (!is_dir($livewirePath)) {
        return;
    }

    $finder = new Finder();
    $finder->files()->in($livewirePath)->name('*.php');

    foreach ($finder as $file) {
        $relativePath = $file->getRelativePathname();
        $className = $livewireNamespace . '\\' . str_replace('/', '\\', Str::before($relativePath, '.php'));

        if (is_subclass_of($className, \Livewire\Component::class)) {
            if (method_exists($className, 'route')) {
                app()->call([$className, 'route']);
            }
        }
    }
});
