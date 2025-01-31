<?php
namespace App\Modules\Subcategory\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Subcategory\Http\Generator\SubcategoryDatatableGenerator;
use App\Modules\Subcategory\Http\Generator\SubcategoryFormGenerator;
use App\Base\Requests\BaseDatatableRequest;
use App\Modules\Subcategory\Http\Services\SubcategoryCrudService;
use App\Modules\Subcategory\Http\Services\SubcategoryDeleteService;
use App\Modules\Subcategory\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index(SubcategoryDatatableGenerator $generator)
    {
        $datatable = $generator->getStructure();
        return view('subcategory::subcategory.index', [
            'title' => 'Subcategory Management',
            'datatable' => $datatable,
            'create_route' => 'cms.subcategory.create',
        ]);
    }

    public function datatable(BaseDatatableRequest $request, SubcategoryDatatableGenerator $generator)
    {
        $datatable = $generator->getStructure();
        return $datatable->datatableResponse($request);
    }

    public function create(SubcategoryFormGenerator $generator)
    {
        $form = $generator->getStructure();
        return view('subcategory::subcategory.crud', [
            'title' => 'Create New Subcategory',
            'route' => route('cms.subcategory.store'),
            'back_url' => route('cms.subcategory.index'),
            'form' => $form,
        ]);
    }

    public function store(Request $request, SubcategoryCrudService $service)
    {
        return $this->handleService($request, $service);
    }

    public function edit($id, SubcategoryFormGenerator $generator)
    {
        $form = $generator->getStructure();
        $form->setData(Subcategory::find($id));

        return view('subcategory::subcategory.crud', [
            'title' => 'Update Subcategory',
            'route' => route('cms.subcategory.update', ['id' => $id]),
            'back_url' => route('cms.subcategory.index'),
            'form' => $form,
        ]);
    }

    public function update(Request $request, SubcategoryCrudService $service, $id=null)
    {
        return $this->handleService($request, $service, $id);
    }

    public function delete(Request $request, SubcategoryDeleteService $service, $id=null)
    {
        return $this->handleService($request, $service, $id);
    }
}
