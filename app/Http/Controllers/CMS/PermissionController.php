<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\CMS\PermissionRequest;
use App\Http\Services\CMS\PermissionService;
use App\Http\Services\CMS\PermissionDeleteService;
use App\Components\RoleStructure;
use Auth;
use CMS;
use Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $role_structure = new RoleStructure;
        return view('cms.pages.permission.index', [
            'title' => 'Manage Permission',
            'user' => CMS::adminUser(),
            'role_structure' => $role_structure,
        ]);
    }

    public function create()
    {
        $data = new Role;
        $structure = new RoleStructure;
        $target = route('cms.do-permission');
        return view('cms.pages.permission.crud', [
            'data' => $data,
            'structure' => $structure,
            'target' => $target,
        ])->render();
    }

    public function store(PermissionRequest $request, PermissionService $service)
    {
        return $this->handleService($request, $service);
    }

    public function edit($id)
    {
        $data = Role::findOrFail($id);
        $structure = new RoleStructure;
        $target = route('cms.update-permission', ['id' => $id]);
        return view('cms.pages.permission.crud', [
            'data' => $data,
            'structure' => $structure,
            'target' => $target,
        ])->render();
    }

    public function update($id, PermissionRequest $request, PermissionService $service)
    {
        $request->id = $id;
        return $this->handleService($request, $service);
    }

    public function delete($id, PermissionDeleteService $service)
    {
        $this->request->id = $id;
        return $this->handleService($this->request, $service);
    }

    public function manage($id)
    {
        $data = app('role')->where('id', $id)->first();
        if (empty($data)) {
            abort(404);
        }
        $target = route('cms.store-manage-permission', ['id' => $id]);
        $all = Permission::all();
        $checked = json_decode($data->priviledge_list, true);
        if (!$checked) {
            $checked = [];
        }
        return view('cms.pages.permission.form-manage-permission', compact(
            'data',
            'target',
            'all',
            'checked'
        ))->render();
    }

    public function storeManage($id)
    {
        $data = app('role')->where('id', $id)->first();
        if (empty($data)) {
            abort(404);
        }

        $permission_string = '';
        if (is_array($this->request->check)) {
            $permission_string = json_encode($this->request->check);
        }
        $data->priviledge_list = $permission_string;
        $data->save();
        removeCache('role');
        return redirect()->route('cms.permission')->with('success', 'The permission data has been saved for role "' . $data->name . '"');

    }
}