<?php
namespace App\Modules\Category;

use App\Modules\Category\Models\Category as Model;

// Category is a public class that can be accessed in all modules
class Category
{
    public function __construct()
    {
        
    }

    public function getAll()
    {
        return Model::where('is_active', true)->get();
    }
}