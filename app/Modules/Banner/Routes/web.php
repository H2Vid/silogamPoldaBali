<?php
use App\Modules\Banner\Http\Controllers\BannerController;

Route::group([
    'prefix' => 'banner'
], function($route) {
    $route->get('/', [BannerController::class, 'index'])->name('cms.banner.index');
    $route->post('/datatable', [BannerController::class, 'datatable'])->name('cms.banner.datatable');
    $route->get('/create', [BannerController::class, 'create'])->name('cms.banner.create');
    $route->post('/create', [BannerController::class, 'store'])->name('cms.banner.store');
    $route->get('/edit/{id}', [BannerController::class, 'edit'])->name('cms.banner.edit');
    $route->post('/edit/{id}', [BannerController::class, 'update'])->name('cms.banner.update');
    $route->post('/delete/{id?}', [BannerController::class, 'delete'])->name('cms.banner.delete');
});