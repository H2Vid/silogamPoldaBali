<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use App\Models\Setting;
use App\Models\Role;


class CmsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadHelpers(__DIR__ . '/..');
        $this->routeMapping($this->app->router);
        $this->registerContainer();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    protected function registerContainer()
    {
        $this->app->singleton('db_setting', function ($app) {
            return Setting::get();
        });
        $this->app->singleton('role', function ($app) {
            return (new Role)->allCached();
        });
    }

    protected function routeMapping(Router $router)
    {
        $router->group([
            'middleware' => [
                'cms',
            ],
        ], function ($router) {
            $router->group(['prefix' => config('cms.admin_prefix')], function () {
                require base_path("routes/cms.php");
            });
        });
    }

    protected function loadHelpers($dir)
    {
        foreach (glob($dir . '/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
