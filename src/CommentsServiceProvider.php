<?php

namespace Laraveldesign\Comments;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class CommentsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'comments');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        Livewire::component('comments', \Laraveldesign\Comments\Livewire\Comments::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('comments.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => $this->app->resourcePath('views/vendor/comments'),
            ], 'comments:views');

        }
    }

}
