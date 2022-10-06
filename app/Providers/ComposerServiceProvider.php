<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
        //dd('hfglkit');
        view()->composer(
            [
                '*',
                //...more
                // '*' :view name - all views
            ],
            "Modules\News\Http\ViewComposers\CategoryComposer", // class name 
        );
    }
}
