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
            $textsJson = SiteSetting::get('announcement_texts', '[]');
            $announcementTexts = json_decode($textsJson, true) ?? [];
            
            // Fallback to old text if empty
            if (empty($announcementTexts)) {
                $oldText = SiteSetting::get('announcement_text', '');
                if (!empty($oldText)) {
                    $announcementTexts = [['text' => $oldText]];
                }
            }

            $view->with([
                'navItemsLeft' => NavItem::active()->ordered()->left()
                    ->with('megaGroups.items')->get(),
                'navItemsRight' => NavItem::active()->ordered()->right()
                    ->with('megaGroups.items')->get(),
                'announcementTexts' => $announcementTexts,
            ]);
        });
    }
}

