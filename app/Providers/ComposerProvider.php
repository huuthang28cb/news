<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // dd('hfglkit');
        view()->composer(
            [
                'resources\views\admin\partials\header.blade.php',
                //...more
                // '*' :view name - all views
            ],
            "Modules\Home\Http\ViewComposers\PostComposers", // class name 
        );
    }
}
