<?php
namespace App\Libraries;

use Auth;
use Permission;

class CMS 
{
    public function __construct()
    {

    }

    /**
     * Admin authentication helper methods
     */

    public static function adminGuard()
    {
        $guard_name = config('cms.auth_guard_name');
        return Auth::guard($guard_name);
    }
    
    public static function adminUser()
    {
        $guard_name = config('cms.auth_guard_name');
        return Auth::guard($guard_name)->user();
    }

    public static function adminIsLoggedIn()
    {
        $guard_name = config('cms.auth_guard_name');
        return Auth::guard($guard_name)->check();
    }

    /**
     * General helpers
     */ 

    public static function slugify(string $text): string
    {
        $input = preg_replace("/[^a-zA-Z0-9- &]/", "", $text);
        $string = strtolower(str_replace(' ', '-', $input));
        if (strpos($string, '&') !== false) {
            $string = str_replace('&', 'and', $string);
        }
        return $string;
    }
    
    public static function getPrimaryKeyField($modelOrBuilder)
    {
        $pk = 'id';
        if (method_exists($modelOrBuilder, 'getModel')) {
            $model = $modelOrBuilder->getModel();
            $pk = $model->getKeyName();
        } else if (method_exists($modelOrBuilder, 'getKeyName')) {
            $pk = $modelOrBuilder->getKeyName();
        }
        return $pk;
    }

    public static function getFillables($modelOrBuilder)
    {
        $fillable = [];
        if (method_exists($modelOrBuilder, 'getModel')) {
            $model = $modelOrBuilder->getModel();
            $fillable = $model->getFillable();
        } else if (method_exists($modelOrBuilder, 'getFillable')) {
            $fillable = $modelOrBuilder->getFillable();
        }
        return $fillable;
    }
    
    public static function actionButton($action_button_data=[])
    {
        $template = '
        <div class="dropdown dropdown-click show">
            <button title="Action" class="btn-link border-0 bg-transparent p-0" data-toggle="dropdown" aria-haspopup="true">
                <i data-feather="menu"></i> <small>ACTION</small>   
            </button>
            <div class="dropdown-default dropdown-bottomLeft dropdown-menu-right dropdown-menu" x-placement="bottom-end">
        ';

            foreach ($action_button_data as $row) {
                if (isset($row['auth'])) {
                    if (!Permission::has($row['auth'])) {
                        continue;
                    }
                }
                $template .= $row['html'] ?? '';
            }        
        $template .= '
            </div>
        </div>
        ';

        return $template;
    }


    /**
     * Lang Helpers
     */

    public static function langs()
    {
        return config('cms.lang.available', [
            'en' => 'English'
        ]);
    }

    public static function defaultLang()
    {
        return config('cms.lang.default', 'en');
    }

    public static function activeLang()
    {
        return count(config('cms.lang.available', [
            'en' => 'English'
        ]) > 1);
    }

    public static function currentLang()
    {
        if (session('lang')) {
            return session('lang');
        }
        return config('cms.lang.default', 'en');
    }

}