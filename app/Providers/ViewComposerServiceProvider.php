<?php

namespace App\Providers;

use App\Models\PracticeArea;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
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
        /**
         * Share footer data (practice areas + contact config) with the public footer
         * so no DB query ever runs inside the Blade template — data comes from
         * the service layer / config, not from code written in the blade file.
         */
        View::composer('components.public.footer', function ($view) {
            $view->with('footerPracticeAreas', PracticeArea::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->limit(6)
                ->get());

            $view->with('footerContact', [
                'email' => config('nishalawyer.contact.email'),
                'phone' => config('nishalawyer.contact.phone'),
                'address' => config('nishalawyer.contact.address'),
                'hours' => config('nishalawyer.contact.business_hours'),
                'facebook' => config('nishalawyer.social.facebook'),
                'twitter' => config('nishalawyer.social.twitter'),
                'linkedin' => config('nishalawyer.social.linkedin'),
            ]);
        });
    }
}