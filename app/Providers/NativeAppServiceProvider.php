<?php

namespace App\Providers;

use Native\Desktop\Facades\Window;
use Native\Desktop\Contracts\ProvidesPhpIni;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        Window::open()
        ->width(1200)   // Apni pasand ka width (pixels mein)
        ->height(800)   // Apni pasand ka height (pixels mein)
        ->minWidth(800) // Is se choti window nahi hogi
        ->minHeight(600)
        ->showDevTools(false); // Agar developer tools band karne hon
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [
        ];
    }
}
