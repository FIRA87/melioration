<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Blade;
use App\Models\StaticTranslation;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

         Blade::directive('trans', function ($key) {
                return "<?php echo \App\Models\StaticTranslation::trans($key); ?>";
        });

        
        view()->composer('*', function ($view) {
            // Кешируем настройки на 24 часа (они редко меняются)
            $siteSettings = Cache::remember('site_settings', 86400, function () {
                return \App\Models\Setting::find(1);
            });
            
            // Кешируем страницы на 1 час
            $pages = Cache::remember('active_pages', 3600, function () {
                return \App\Models\Page::where('status', 1)->orderBy('id')->get();
            });
            
            // Кешируем подстраницы на 1 час
            $subPages = Cache::remember('active_subpages', 3600, function () {
                return \App\Models\SubPage::where('status', 1)
                    ->orderBy('sort')
                    ->get()
                    ->groupBy('page_id');
            });
            
            $view->with([
                'siteSettings' => $siteSettings,
                'pages' => $pages,
                'subPages' => $subPages
            ]);
        });
    }
}