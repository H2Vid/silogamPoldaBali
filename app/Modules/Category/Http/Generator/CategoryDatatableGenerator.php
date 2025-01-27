<?php
namespace App\Modules\Category\Http\Generator;

use App\Components\Datatable\DatatableRenderer;
use App\Components\Datatable\DatatableField;
use App\Contracts\DatatableGenerator;
use App\Modules\Category\Models\Category;
use Illuminate\Http\Request;
use Storage;
use CMS;
use Setting;

class CategoryDatatableGenerator extends DatatableGenerator
{
    public function structure(): DatatableRenderer
    {
        $structure = (new DatatableRenderer)->with([
            'title' => 'category',
            'route' => route('cms.category.datatable'),
            'batch_delete_route' => route('cms.category.delete'),
            'model' => Category::query(),
            'default_sort_by' => 'id',
            'default_sort_dir' => 'DESC',
            'config' => [
                (new DatatableField)->setField('title')
                    ->setLabel('Title'),
                (new DatatableField)->setField('image')
                    ->setLabel('Image')
                    ->setSearchable(false)
                    ->setOrderable(false),
                (new DatatableField)->setField('is_active')
                    ->setLabel('Status'),
            ],
            'search_handle' => function($builder, $search_keyword, Request $request) {
                if (strlen($search_keyword) > 0) {
                    $builder = $builder->where(function($qry) use($search_keyword) {
                        $search_keyword = str_replace(' ', '%', $search_keyword);
                        $qry->where('title', 'LIKE', '%'.$search_keyword.'%');
                        $qry->orWhere('description', 'LIKE', '%'.$search_keyword.'%');
                    });
                }
                return $builder;
            }
        ]);

        $structure->setTableData(function($row) {
            return [
                'title' => $row->title,
                'description' => $row->description,
                'image' => $row->image ? '<img src="'.Storage::url($row->image).'" style="height:30px;">' : '-',
                'is_active' => $row->is_active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Not Active</span>',
                'action' => CMS::actionButton([
                    [
                        'auth' => 'cms.category.edit',
                        'html' => '<a href="'.route('cms.category.edit', ['id' => $row->id]).'" class="dropdown-item ajax-priority">
                            <i data-feather="edit-3" class="text-primary"></i>
                            <span>Edit</span>    
                        </a>',
                    ],
                    [
                        'auth' => 'cms.category.delete',
                        'html' => '<a href="#" data-target="'.route('cms.category.delete', ['id' => $row->id]).'" class="dropdown-item '.(Setting::get('general.ask_delete') ? 'delete-button' : 'btn-trigger-delete').'">
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