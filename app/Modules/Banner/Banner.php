<?php
namespace App\Modules\Banner;

use App\Modules\Banner\Models\Banner as Model;

// Banner is a public class that can be accessed in all modules
class Banner
{
    public function __construct()
    {
        
    }

    public function getAll()
    {
        return Model::where('is_active', true)->get();
    }
}