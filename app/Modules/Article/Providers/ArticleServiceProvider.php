<?php
namespace App\Modules\Article\Providers;

use App\Base\Providers\BaseServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;

class ArticleServiceProvider extends BaseServiceProvider
{
    protected $namespace = 'App\Modules\Article\Http\Controllers';

    public function boot()
    {
        $this->loadMigrationsFrom(realpath(__DIR__ . "/../Migrations"));
    }

    public function register()
    {
        $this->loadHelpers(__DIR__ . '/..');
        $this->mapping($this->app->router);
        $this->loadViewsFrom(realpath(__DIR__ . "/../Resources/views"), 'article');
        $this->mergeMainConfig();
        $this->registerAlias();
    }

    protected function mergeMainConfig()
    {
        $configs = ['module', 'menu', 'permission'];
        foreach ($configs as $cfg) {
            $this->mergeConfigFrom(
                __DIR__ . '/../Configs/'.$cfg.'.php', $cfg
            );    
        }
    }

    protected function mapping(Router $router)
    {
        $router->group([
            'middleware' => [
                'web',
                'cmsauth:cms',
            ],
        ], function ($router) {
            $router->group(['prefix' => config('cms.admin_prefix')], function () {
                require realpath(__DIR__ . "/../Routes/web.php");
            });
        });
    }

    protected function registerAlias()
    {
        //automatically load alias
        $aliasData = [
            'Article' => \App\Modules\Article\Facades\Article::class,
        ];

        foreach ($aliasData as $al => $src) {
            AliasLoader::getInstance()->alias($al, $src);
        }
    }
}
