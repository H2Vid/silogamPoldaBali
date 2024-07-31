<?php
namespace App\Http\Services\CMS;

use App\Base\Services\BaseCrudService;
use Illuminate\Http\Request;
use App\Http\Generator\UserFormGenerator;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

class UserCrudService extends BaseCrudService
{
    public function structure($id=null)
    {
        $form = (new UserFormGenerator)->getStructure();
        if ($id) {
            $form->setData(User::with('roles')->findOrFail($id));
        } else {
            $form->setData(new User);
        }
        return $form;
    }

    // can still return error and no data created/updated yet
    public function beforeCrud(Request $request, $instance)
    {
        $instance->reformatted_email = reformatEmail($instance->email);
        if ($this->mode == 'store') {
            $instance->password = bcrypt($instance->password);
        }

        if (User::where('reformatted_email', $instance->reformatted_email)->where('id', '<>', $this->id ?? '0')->count() > 0) {
            return $this->error('Email is already used by another user', null, 400);
        }

        return $instance;
    }

    public function afterCrud(Request $request, $instance)
    {
        // hook after successfully create/update data
        UserRole::where('user_id', $instance->id)->delete();
        $ur = [];
        foreach ($request->role ?? [] as $role_id) {
            $ur[] = [
                'user_id' => $instance->id,
                'role_id' => $role_id,
            ];
        }
        UserRole::insert($ur);
    }

    public function successRedirectTarget()
    {
        return route('cms.user.index');
    }

    public function successRedirectMessage()
    {
        return 'Data has been saved successfully';
    }

}