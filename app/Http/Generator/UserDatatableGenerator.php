<?php
namespace App\Http\Generator;

use App\Components\Datatable\DatatableRenderer;
use App\Components\Datatable\DatatableField;
use App\Contracts\DatatableGenerator;
use App\Models\User;
use Illuminate\Http\Request;
use Storage;
use CMS;
use Setting;

class UserDatatableGenerator extends DatatableGenerator
{
    public function structure(): DatatableRenderer
    {
        $structure = (new DatatableRenderer)->with([
            'title' => 'user',
            'route' => route('cms.user.datatable'),
            'batch_delete_route' => route('cms.user.delete'),
            'model' => User::with('roles'),
            'default_sort_by' => 'id',
            'default_sort_dir' => 'DESC',
            'config' => [
                (new DatatableField)->setField('name')
                    ->setLabel('Name'),
                (new DatatableField)->setField('email')
                    ->setLabel('Email'),
                    (new DatatableField)->setField('role')
                    ->setLabel('Role')
                    ->setSearchable(false)
                    ->setOrderable(false),
                (new DatatableField)->setField('image')
                    ->setLabel('Image')
                    ->setSearchable(false)
                    ->setOrderable(false),
                (new DatatableField)->setField('is_active')
                    ->setLabel('Status'),
            ],
            'search_handle' => function($builder, $search_keyword, Request $request) {
                if (!$request->get('is_sa')) {
                    $builder->whereHas('roles', function($sub) {
                        $sub->whereNull('is_sa')->orWhere('is_sa', 0);
                    });
                }
                if (strlen($search_keyword) > 0) {
                    $builder = $builder->where(function($qry) use($search_keyword) {
                        $search_keyword = str_replace(' ', '%', $search_keyword);
                        $qry->where('name', 'LIKE', '%'.$search_keyword.'%');
                        $qry->orWhere('email', 'LIKE', '%'.$search_keyword.'%');
                    });
                }
                return $builder;
            }
        ]);

        $structure->setTableData(function($row) {
            $role = null;
            foreach ($row->roles as $rol) {
                $role .= '<span class="badge badge-primary">'.$rol->name.'</span> ';
            }

            return [
                'name' => $row->name,
                'email' => $row->email,
                'image' => $row->image ? '<img src="'.Storage::url($row->image).'" style="height:30px;">' : '-',
                'role' => $role,
                'is_active' => $row->is_active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Not Active</span>',
                'action' => CMS::actionButton([
                    [
                        'auth' => 'cms.user.edit',
                        'html' => '<a href="'.route('cms.user.edit', ['id' => $row->id]).'" class="dropdown-item ajax-priority">
                            <i data-feather="edit-3" class="text-primary"></i>
                            <span>Edit</span>    
                        </a>',
                    ],
                    [
                        'auth' => 'cms.user.delete',
                        'html' => '<a href="#" data-target="'.route('cms.user.delete', ['id' => $row->id]).'" class="dropdown-item '.(Setting::get('general.ask_delete') ? 'delete-button' : 'btn-trigger-delete').'">
                            <i data-feather="x" class="text-danger"></i>
                            <span>Delete</span>    
                        </a>',
                    ],                        
                ]),
            ];        
        });

        return $structure;
    }

}