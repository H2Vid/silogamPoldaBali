<?php
use App\Modules\SubCategory\Http\Controllers\SubcategoryController;

Route::group([
    'prefix' => 'subcategory'
], function($route) {
    $route->get('/', [SubcategoryController::class, 'index'])->name('cms.subcategory.index');
    $route->post('/datatable', [SubcategoryController::class, 'datatable'])->name('cms.subcategory.datatable');
    $route->get('/create', [SubcategoryController::class, 'create'])->name('cms.subcategory.create');
    $route->post('/create', [SubcategoryController::class, 'store'])->name('cms.subcategory.store');
    $route->get('/edit/{id}', [SubcategoryController::class, 'edit'])->name('cms.subcategory.edit');
    $route->post('/edit/{id}', [SubcategoryController::class, 'update'])->name('cms.subcategory.update');
    $route->post('/delete/{id?}', [SubcategoryController::class, 'delete'])->name('cms.subcategory.delete');
});
