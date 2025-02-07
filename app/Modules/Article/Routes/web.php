<?php
use App\Modules\Article\Http\Controllers\ArticleController;

Route::group([
    'prefix' => 'article'
], function($route) {
    // $route->get('/', [ArticleController::class, 'index'])->name('cms.article.index');
    // $route->post('/datatable', [ArticleController::class, 'datatable'])->name('cms.article.datatable');
    // $route->get('/create', [ArticleController::class, 'create'])->name('cms.article.create');
    // $route->post('/create', [ArticleController::class, 'store'])->name('cms.article.store');
    // $route->get('/edit/{id}', [ArticleController::class, 'edit'])->name('cms.article.edit');
    // $route->post('/edit/{id}', [ArticleController::class, 'update'])->name('cms.article.update');
    // $route->post('/delete/{id?}', [ArticleController::class, 'delete'])->name('cms.article.delete');
});