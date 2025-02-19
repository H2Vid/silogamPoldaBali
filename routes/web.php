<?php

use App\Models\User;
use App\Libraries\CMS;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Modules\Article\Models\Article;
use App\Http\Controllers\DataController;
use App\Modules\Category\Models\Category;
use App\Http\Requests\CMS\AuthLoginRequest;

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

        $sliders = [
            [
                'image' => 'KARO.png',
                'title' => 'Kombes Pol Tri Bisono Soemiharso',
                'subtitle' => 'Kepala Biro SDM Polda Bali',
            ],
            [
                'image' => 'KABAGBINKAR.png',
                'title' => 'AKBP MICHAEL R. RISAKOTTA, S.H., S.I.K.',
                'subtitle' => 'KABAGBINKAR RO SDM POLDA BALI',
            ],
            [
                'image' => 'KABAGDALPERS.png',
                'title' => 'AKBP RICKO ABDILLAH ANDANG TARUNA, S.H., S.I.K., M.H., M.M.',
                'subtitle' => 'KABAGDALPERS RO SDM POLDA BALI',
            ],
            [
                'image' => 'KABAGPSI.png',
                'title' => 'AKBP I NYOMAN WIBAWA, S.Psi., M.Psi.',
                'subtitle' => 'PS. KABAGPSI RO SDM POLDA BALI',
            ],
            [
                'image' => 'PLT_KABAGWATPERS.png',
                'title' => 'KOMPOL ANAK AGUNG GEDE ARKA, S.H., M.H.',
                'subtitle' => 'PLT. KABAGWATPERS RO SDM POLDA BALI',
            ],
        ];

        $banners = [

            [
                'image' => 'SPANDUK ZI FIX.png',
            ],
            [
                'image' => 'SPANDUK ZI FIX.png',
            ],
            [
                'image' => 'SPANDUK ZI FIX.png',
            ],
            [
                'image' => 'SPANDUK ZI FIX.png',
            ],
        ];

        return view('pages.home.index', compact('sliders','banners')); // Mengirimkan data ke view

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

Route::get('/category/{slug}', [DataController::class, 'index'])->name('category');

Route::get('subcategory/{slug}', [DataController::class, 'showSubcategory'])->name('subcategory.show');
