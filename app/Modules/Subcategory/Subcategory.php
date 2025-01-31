<?php
namespace App\Modules\SubCategory;

use App\Modules\SubCategory\Models\Subcategory as Model;

// Subcategory is a public class that can be accessed in all modules
class Subcategory
{
    public function __construct()
    {
        // Konstruktor kosong (bisa dihapus jika tidak digunakan)
    }

    public function getAll()
    {
        return Model::all();
    }
}
