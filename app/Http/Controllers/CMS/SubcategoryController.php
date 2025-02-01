<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        return view('cms.pages.subcategory.index');
    }
    public function crud()
    {
        // Menampilkan halaman create (crud)
        return view('cms.pages.subcategory.crud');
    }
}
