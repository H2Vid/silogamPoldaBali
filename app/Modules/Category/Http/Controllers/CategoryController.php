<?php
namespace App\Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Category\Http\Generator\CategoryDatatableGenerator;
use App\Modules\Category\Http\Generator\CategoryFormGenerator;
use App\Base\Requests\BaseDatatableRequest;
use App\Modules\Category\Http\Services\CategoryCrudService;
use App\Modules\Category\Http\Services\CategoryDeleteService;
use App\Modules\Category\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(CategoryDatatableGenerator $generator)
    {
        $datatable = $generator->getStructure();
        return view('category::category.index', [
            'title' => 'Category Management',
            'datatable' => $datatable,
            'create_route' => 'cms.category.create',
        ]);
    }

    public function datatable(BaseDatatableRequest $request, CategoryDatatableGenerator $generator)
    {
        $datatable = $generator->getStructure();
        return $datatable->datatableResponse($request);
    }

    public function create(CategoryFormGenerator $generator)
    {
        $form = $generator->getStructure();
        return view('category::category.crud', [
            'title' => 'Create New Category',
            'route' => route('cms.category.store'),
            'back_url' => route('cms.category.index'),
            'form' => $form,
        ]);
    }
    
    public function store(Request $request, CategoryCrudService $service)
    {
        return $this->handleService($request, $service);
    }
    
    public function edit($id, CategoryFormGenerator $generator)
    {
        $form = $generator->getStructure();
        $form->setData(Category::find($id));

        return view('category::category.crud', [
            'title' => 'Update Category',
            'route' => route('cms.category.update', ['id' => $id]),
            'back_url' => route('cms.category.index'),
            'form' => $form,
        ]);
    }

    public function update(Request $request, CategoryCrudService $service, $id=null)
    {
        return $this->handleService($request, $service, $id);
    }
    
    public function delete(Request $request, CategoryDeleteService $service, $id=null)
    {
        return $this->handleService($request, $service, $id);
    }

}