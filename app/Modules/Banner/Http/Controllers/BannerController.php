<?php
namespace App\Modules\Banner\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Banner\Http\Generator\BannerDatatableGenerator;
use App\Modules\Banner\Http\Generator\BannerFormGenerator;
use App\Base\Requests\BaseDatatableRequest;
use App\Modules\Banner\Http\Services\BannerCrudService;
use App\Modules\Banner\Http\Services\BannerDeleteService;
use App\Modules\Banner\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(BannerDatatableGenerator $generator)
    {
        $datatable = $generator->getStructure();
        return view('banner::banner.index', [
            'title' => 'Banner Management',
            'datatable' => $datatable,
            'create_route' => 'cms.banner.create',
        ]);
    }

    public function datatable(BaseDatatableRequest $request, BannerDatatableGenerator $generator)
    {
        $datatable = $generator->getStructure();
        return $datatable->datatableResponse($request);
    }

    public function create(BannerFormGenerator $generator)
    {
        $form = $generator->getStructure();
        return view('banner::banner.crud', [
            'title' => 'Create New Banner',
            'route' => route('cms.banner.store'),
            'back_url' => route('cms.banner.index'),
            'form' => $form,
        ]);
    }
    
    public function store(Request $request, BannerCrudService $service)
    {
        return $this->handleService($request, $service);
    }
    
    public function edit($id, BannerFormGenerator $generator)
    {
        $form = $generator->getStructure();
        $form->setData(Banner::find($id));

        return view('banner::banner.crud', [
            'title' => 'Update Banner',
            'route' => route('cms.banner.update', ['id' => $id]),
            'back_url' => route('cms.banner.index'),
            'form' => $form,
        ]);
    }

    public function update(Request $request, BannerCrudService $service, $id=null)
    {
        return $this->handleService($request, $service, $id);
    }
    
    public function delete(Request $request, BannerDeleteService $service, $id=null)
    {
        return $this->handleService($request, $service, $id);
    }

}