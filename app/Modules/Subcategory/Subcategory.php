<?php
namespace App\Modules\Subcategory;

use App\Modules\Subcategory\Models\Subcategory as Model;

// Subcategory is a public class that can be accessed in all modules
class Subcategory
{
    public function __construct()
    {

    }

    public function getAll()
    {
        return Model::where('is_active', true)->get();
    }
}
