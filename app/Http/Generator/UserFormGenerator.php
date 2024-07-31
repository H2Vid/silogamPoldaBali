<?php
namespace App\Http\Generator;

use App\Components\Form\FormRenderer;
use App\Components\Form\FormField;
use App\Contracts\FormGenerator;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Storage;
use CMS;

class UserFormGenerator extends FormGenerator
{
    public function structure(): FormRenderer
    {
        $structure = (new FormRenderer)->with([
            'title' => 'user',
            'model' => User::with('roles'),
            'config' => [
                (new FormField)->setField('name')
                    ->setLabel('Name')
                    ->setType('text')
                    ->setColumn(12)
                    ->setValidation('required')
                    ->use(),
                (new FormField)->with([
                    'field' => 'email',
                    'label' => 'Email',
                    'type' => 'email',
                    'validation' => 'required|email|unique:users,email,[id]',
                ])->use(),
                (new FormField)->with([
                    'field' => 'password',
                    'label' => 'Password',
                    'type' => 'password',
                    'hide_on_update' => true,
                    'column' => 6,
                    'validation' => 'required|confirmed|min:6',
                    'value' => function($data) {
                        // force blank
                        return null;
                    },
                ])->use(),
                (new FormField)->with([
                    'field' => 'password_confirmation',
                    'label' => 'Repeat Password',
                    'type' => 'password',
                    'hide_on_update' => true,
                    'column' => 6,
                    'value' => function($data) {
                        // force blank
                        return null;
                    },
                ])->use(),
                (new FormField)->with([
                    'field' => 'role[]',
                    'label' => 'Role',
                    'type' => 'selectMultiple',
                    'lists' => function(){
                        $is_sa = request()->get('is_sa');
                        return Role::when(!$is_sa, function($qry) {
                            $qry->where('is_sa', 0)->orWhereNull('is_sa');
                        })->get(['id', 'name'])->pluck('name', 'id');
                    },
                    'value' => function($data) {
                        if (isset($data->id)) {
                            return $data->roles->pluck('id')->toArray();
                        }
                    }
                ])->use(),
                (new FormField)->with([
                    'field' => 'image',
                    'label' => 'Image',
                    'type' => 'image',
                    'column' => 4,
                    'notes' => 'Please upload with JPG/PNG format maximum 1MB '
                ])->use(),
                (new FormField)->with([
                    'field' => 'is_active',
                    'label' => 'Is Active',
                    'type' => 'yesno',
                    'column' => 4,
                ])->use(),
            ],
        ]);

        return $structure;
    }

}