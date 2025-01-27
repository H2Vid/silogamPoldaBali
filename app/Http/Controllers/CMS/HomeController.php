<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Modules\Article\Models\Article;
use App\Modules\Category\Models\Category;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $latest_post = Article::latest()->take(10)->get();
        $categories = Category::where('is_active', true)->get();
        $admin = User::get();

        return view('cms.index', [
            'title' => 'Dashboard',
            'latest_post' => $latest_post,
            'categories' => $categories,
            'admin' => $admin,
        ]);
    }
}