<?php
use App\Http\Controllers\CMS\LogController;
use App\Http\Controllers\CMS\AuthController;
use App\Http\Controllers\CMS\HomeController;
use App\Http\Controllers\CMS\UserController;
use App\Http\Controllers\CMS\UploadController;
use App\Http\Controllers\CMS\ProfileController;
use App\Http\Controllers\CMS\SettingController;
use App\Http\Controllers\CMS\ArticlesController;
use App\Http\Controllers\CMS\PermissionController;
use App\Http\Controllers\CMS\SubcategoryController;


Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('cms.auth.reset-password');
Route::post('/reset-password', [AuthController::class, 'doResetPassword'])->name('cms.auth.do-reset-password');
Route::match(['get', 'post'], 'logout', [AuthController::class, 'logout'])->name('cms.auth.logout');

Route::group([
    'middleware' => 'cmsauth:cms'
], function() {
    Route::get('/', [HomeController::class, 'index'])->name('cms.index');
    Route::get('/articles', [ArticlesController::class, 'index'])->name('cms.articles.index');
    Route::get('/articles/create', [ArticlesController::class, 'crud'])->name('cms.articles.crud');
    Route::post('/articles/save', [ArticlesController::class, 'save'])->name('articles.save');
    Route::get('/articles/edit/{id}', [ArticlesController::class, 'edit'])->name('cms.articles.edit');
    Route::post('/articles/delete/{id}', [ArticlesController::class, 'destroy'])->name('cms.articles.delete');




    Route::get('/subcategory', [SubcategoryController::class, 'index'])->name('cms.subcategory.index');
    Route::get('/subcategory/create', [SubcategoryController::class, 'crud'])->name('cms.subcategory.crud');
    Route::post('/subcategory/store', [SubcategoryController::class, 'store'])->name('subcategory.store');
    Route::get('/subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('cms.subcategory.edit');
    Route::put('/subcategory/update/{id}', [SubcategoryController::class, 'update'])->name('cms.subcategory.update');
    Route::post('/subcategory/delete/{id}', [SubcategoryController::class, 'destroy'])->name('cms.subcategory.delete');



    Route::get('/setting', [SettingController::class, 'setting'])->name('cms.setting');
    Route::post('/setting', [SettingController::class, 'doSetting'])->name('cms.do-setting');
    Route::get('/profile', [ProfileController::class, 'index'])->name('cms.profile');
    Route::post('/profile', [ProfileController::class, 'store'])->name('cms.do-profile');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('cms.change-password');
    Route::post('/change-password', [ProfileController::class, 'doChangePassword'])->name('cms.do-change-password');
    Route::get('/permission', [PermissionController::class, 'index'])->name('cms.permission');
    Route::get('/permission/create', [PermissionController::class, 'create'])->name('cms.create-permission');
    Route::post('/permission', [PermissionController::class, 'store'])->name('cms.do-permission');
    Route::get('/permission/edit/{id}', [PermissionController::class, 'edit'])->name('cms.edit-permission');
    Route::post('/permission/edit/{id}', [PermissionController::class, 'update'])->name('cms.update-permission');
    Route::get('/permission/manage/{id}', [PermissionController::class, 'manage'])->name('cms.manage-permission');
    Route::post('/permission/manage/{id}', [PermissionController::class, 'storeManage'])->name('cms.store-manage-permission');
    Route::post('/permission/delete/{id}', [PermissionController::class, 'delete'])->name('cms.delete-permission');

    Route::get('/user', [UserController::class, 'index'])->name('cms.user.index');
    Route::post('/user/datatable', [UserController::class, 'datatable'])->name('cms.user.datatable');
    Route::get('/user/create', [UserController::class, 'create'])->name('cms.user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('cms.user.store');
    Route::get('/user/edit/{id?}', [UserController::class, 'edit'])->name('cms.user.edit');
    Route::post('/user/edit/{id?}', [UserController::class, 'update'])->name('cms.user.update');
    Route::post('/user/delete/{id?}', [UserController::class, 'delete'])->name('cms.user.delete');

    Route::get('log', [LogController::class, 'index'])->name('cms.log.index');
    Route::get('log/export', [LogController::class, 'export'])->name('cms.log.export');

    Route::post('/api/upload-image', [UploadController::class, 'image'])->name('cms.api.upload-image');
    Route::post('/api/upload-file', [UploadController::class, 'file'])->name('cms.api.upload-file');

});

Route::group([
    'middleware' => 'cmsguest'
], function() {
    Route::get('/login', [AuthController::class, 'login'])->name('cms.auth.login');
    Route::post('/login', [AuthController::class, 'doLogin'])->name('cms.auth.do-login');
    Route::get('/register', [AuthController::class, 'register'])->name('cms.auth.register');
    Route::post('/register', [AuthController::class, 'doRegister'])->name('cms.auth.do-register');
    Route::post('/forgot-password', [AuthController::class, 'doForgotPassword'])->name('cms.auth.do-forgot-password');

});
