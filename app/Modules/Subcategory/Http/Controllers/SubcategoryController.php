<?php
namespace App\Modules\SubCategory\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\SubCategory\Http\Generator\SubCategoryDatatableGenerator;
use App\Modules\SubCategory\Http\Generator\SubCategoryFormGenerator;
use App\Base\Requests\BaseDatatableRequest;
use App\Modules\SubCategory\Http\Services\SubCategoryCrudService;
use App\Modules\SubCategory\Http\Services\SubCategoryDeleteService;
use App\Modules\SubCategory\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(SubCategoryDatatableGenerator $generator)
    {
        $datatable = $generator->getStructure();
        return view('subcategory::subcategory.index', [
            'title' => 'SubCategory Management',
            'datatable' => $datatable,
            'create_route' => 'cms.subcategory.create',
        ]);
    }

    public function datatable(BaseDatatableRequest $request, SubCategoryDatatableGenerator $generator)
    {
        $datatable = $generator->getStructure();
        return $datatable->datatableResponse($request);
    }

    public function create(SubCategoryFormGenerator $generator)
    {
        $form = $generator->getStructure();
        return view('subcategory::subcategory.crud', [
            'title' => 'Create New SubCategory',
            'route' => route('cms.subcategory.store'),
            'back_url' => route('cms.subcategory.index'),
            'form' => $form,
        ]);
    }

    public function store(Request $request, SubCategoryCrudService $service)
    {
        return $this->handleService($request, $service);
    }

    public function edit($id, SubCategoryFormGenerator $generator)
    {
        $form = $generator->getStructure();
        $form->setData(SubCategory::find($id));

        return view('subcategory::subcategory.crud', [
            'title' => 'Update SubCategory',
            'route' => route('cms.subcategory.update', ['id' => $id]),
            'back_url' => route('cms.subcategory.index'),
            'form' => $form,
        ]);
    }

    public function update(Request $request, SubCategoryCrudService $service, $id=null)
    {
        return $this->handleService($request, $service, $id);
    }

    public function delete(Request $request, SubCategoryDeleteService $service, $id=null)
    {
        return $this->handleService($request, $service, $id);
    }
}
