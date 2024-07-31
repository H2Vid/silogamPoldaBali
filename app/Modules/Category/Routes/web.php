<?php
use App\Modules\Category\Http\Controllers\CategoryController;

Route::group([
    'prefix' => 'category'
], function($route) {
    $route->get('/', [CategoryController::class, 'index'])->name('cms.category.index');
    $route->post('/datatable', [CategoryController::class, 'datatable'])->name('cms.category.datatable');
    $route->get('/create', [CategoryController::class, 'create'])->name('cms.category.create');
    $route->post('/create', [CategoryController::class, 'store'])->name('cms.category.store');
    $route->get('/edit/{id}', [CategoryController::class, 'edit'])->name('cms.category.edit');
    $route->post('/edit/{id}', [CategoryController::class, 'update'])->name('cms.category.update');
    $route->post('/delete/{id?}', [CategoryController::class, 'delete'])->name('cms.category.delete');
});