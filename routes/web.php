<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CMS\AuthLoginRequest;
use App\Models\User;
use CMS;

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

Route::get('/category/{slug}', function() {

})->name('category');

Route::get('/post/{slug}', function() {
    
})->name('post');