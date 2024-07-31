<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Generator\UserDatatableGenerator;
use App\Http\Generator\UserFormGenerator;
use App\Base\Requests\BaseDatatableRequest;
use App\Http\Services\CMS\UserCrudService;
use App\Http\Services\CMS\UserDeleteService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserDatatableGenerator $generator)
    {
        $datatable = $generator->getStructure();
        return view('cms.pages.user.index', [
            'title' => 'User Management',
            'datatable' => $datatable,
        ]);
    }

    public function datatable(BaseDatatableRequest $request, UserDatatableGenerator $generator)
    {
        $datatable = $generator->getStructure();
        return $datatable->datatableResponse($request);
    }

    public function create(UserFormGenerator $generator)
    {
        $form = $generator->getStructure();
        return view('cms.pages.user.crud', [
            'title' => 'Create New User',
            'route' => route('cms.user.store'),
            'form' => $form,
        ]);
    }
    
    public function store(Request $request, UserCrudService $service)
    {
        return $this->handleService($request, $service);
    }
    
    public function edit($id, UserFormGenerator $generator)
    {
        $form = $generator->getStructure();
        $form->setData(User::with('roles')->find($id));

        return view('cms.pages.user.crud', [
            'title' => 'Update User',
            'route' => route('cms.user.update', ['id' => $id]),
            'form' => $form,
        ]);
    }

    public function update(Request $request, UserCrudService $service, $id=null)
    {
        return $this->handleService($request, $service, $id);
    }
    
    public function delete(Request $request, UserDeleteService $service, $id=null)
    {
        return $this->handleService($request, $service, $id);
    }

}