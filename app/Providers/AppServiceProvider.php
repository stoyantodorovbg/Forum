<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Channel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function ($view) {
//            $channels = Cache::rememberForever('channels', function () {
//                return Channel::all();
//            });
            $channels = Channel::where('status', 1)->get();

            $view->with('channels', $channels);
        });

        \View::composer('admin/*', function ($view) {

            $sideMenu = Menu::where('title', 'Admin Side Menu')
                ->where('status', 1)
                ->first();

            if ($sideMenu) {
                $sideMenu->load(['menuItems' => function($query) {
                    $query->where('status', 1)
                        ->orderBy('position')
                        ->with(['childMenu' => function($query1) {
                        $query1->with(['menuItems' => function($query2) {
                            $query2->where('status', 1)
                                ->orderBy('position')
                                ->with('childMenu');
                        }]);
                    }]);
                }]);
            }

            $view->with('sideMenu', $sideMenu);
        });

        \Validator::extend('spamfree', 'App\Rules\SpamFree@passes');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
