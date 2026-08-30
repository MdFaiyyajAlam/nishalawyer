<?php

namespace App\Providers;

use App\Services\AppointmentService;
use App\Services\AuthService;
use App\Services\BlogService;
use App\Services\CaseService;
use App\Services\ContactService;
use App\Services\DocumentService;
use App\Services\ReportService;
use App\Services\SettingService;
use App\Services\TestimonialService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind services as singletons for performance
        $this->app->singleton(AuthService::class);
        $this->app->singleton(AppointmentService::class);
        $this->app->singleton(CaseService::class);
        $this->app->singleton(DocumentService::class);
        $this->app->singleton(BlogService::class);
        $this->app->singleton(ContactService::class);
        $this->app->singleton(SettingService::class);
        $this->app->singleton(ReportService::class);
        $this->app->singleton(TestimonialService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register custom blade directives
        \Blade::directive('advocateName', function () {
            return "<?php echo config('nishalawyer.advocate.name', 'Advocate Nisha'); ?>";
        });

        \Blade::directive('advocatePhone', function () {
            return "<?php echo config('nishalawyer.advocate.phone', ''); ?>";
        });

        \Blade::directive('advocateEmail', function () {
            return "<?php echo config('nishalawyer.advocate.email', ''); ?>";
        });

        // @role('slug') ... @endrole — conditional block for users with a given role slug
        \Blade::if('role', function (string $slug) {
            $user = auth()->user();

            return $user && $user->hasRole($slug);
        });
    }
}
