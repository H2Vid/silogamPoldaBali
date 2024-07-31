<?php
namespace App\Modules\Article\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Article\Http\Generator\ArticleDatatableGenerator;
use App\Modules\Article\Http\Generator\ArticleFormGenerator;
use App\Base\Requests\BaseDatatableRequest;
use App\Modules\Article\Http\Services\ArticleCrudService;
use App\Modules\Article\Http\Services\ArticleDeleteService;
use App\Modules\Article\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(ArticleDatatableGenerator $generator)
    {
        $datatable = $generator->getStructure();
        return view('article::article.index', [
            'title' => 'Article Management',
            'datatable' => $datatable,
            'create_route' => 'cms.article.create',
        ]);
    }

    public function datatable(BaseDatatableRequest $request, ArticleDatatableGenerator $generator)
    {
        $datatable = $generator->getStructure();
        return $datatable->datatableResponse($request);
    }

    public function create(ArticleFormGenerator $generator)
    {
        $form = $generator->getStructure();
        return view('article::article.crud', [
            'title' => 'Create New Article',
            'route' => route('cms.article.store'),
            'back_url' => route('cms.article.index'),
            'form' => $form,
        ]);
    }
    
    public function store(Request $request, ArticleCrudService $service)
    {
        return $this->handleService($request, $service);
    }
    
    public function edit($id, ArticleFormGenerator $generator)
    {
        $form = $generator->getStructure();
        $form->setData(Article::find($id));

        return view('article::article.crud', [
            'title' => 'Update Article',
            'route' => route('cms.article.update', ['id' => $id]),
            'back_url' => route('cms.article.index'),
            'form' => $form,
        ]);
    }

    public function update(Request $request, ArticleCrudService $service, $id=null)
    {
        return $this->handleService($request, $service, $id);
    }
    
    public function delete(Request $request, ArticleDeleteService $service, $id=null)
    {
        return $this->handleService($request, $service, $id);
    }

}