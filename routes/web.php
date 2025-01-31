<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CMS\AuthLoginRequest;
use App\Modules\Article\Models\Article;
use App\Modules\Category\Models\Category;
use App\Models\User;
use App\Libraries\CMS;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home.index');
});

Route::post('/login', function(AuthLoginRequest $request) {
    $reformatted_email = reformatEmail($request->email);
    $user = User::where('email', $request->email)->orWhere('reformatted_email', $reformatted_email)->first();
    if (!$user) {
        return response()->json(['type' => 'error', 'message' => 'We cannot find the user with that credential'], 400);
    }
    $user = CMS::adminGuard()->attempt([
        'reformatted_email' => $reformatted_email,
        'password' => $request->password,
    ], $request->has('remember'));
    if (!$user) {
        return response()->json(['type' => 'error', 'message' => "We cannot verify your credential. Please retry again"], 400);
    }

    return [
        'type' => 'success'
    ];
})->name('login');

Route::get('/logout', function() {
    Auth::guard('cms')->logout();
    return redirect('/');
})->name('logout');

Route::get('/category/{slug}', function($slug) {
    $keyword = request()->keyword;
    if (!is_string($keyword)) {
        $keyword = '';
    }
    $keyword = preg_replace('/[^a-zA-Z0-9 ]/', '', $keyword);

    $current_category = null;
    if ($slug <> 'all') {
        $current_category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    return view('pages.category.index', [
        'title' => $current_category ? $current_category->title : 'All Categories',
        'slug' => $slug,
        'keyword' => $keyword,
        'current_category' => $current_category,
    ]);
})->name('category');

Route::get('/post/{slug}', function($slug) {
    $article = Article::with('category')->where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

    $article->addViewer();

    $other_articles = Article::with('category')->where('slug', '<>', $slug)
        ->where('is_active', true)
        ->inRandomOrder()
        ->limit(5)
        ->get();

    return view('pages.post.index', [
        'title' => $article->title,
        'article' => $article,
        'other_articles' => $other_articles,
    ]);
})->name('post');

