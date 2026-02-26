<?php

namespace App\Providers;

use App\Models\NavItem;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $view->with([
                'navItemsLeft' => NavItem::active()->ordered()->left()
                    ->with('megaGroups.items')->get(),
                'navItemsRight' => NavItem::active()->ordered()->right()
                    ->with('megaGroups.items')->get(),
                'announcementText' => SiteSetting::get('announcement_text', ''),
            ]);
        });
    }
}

