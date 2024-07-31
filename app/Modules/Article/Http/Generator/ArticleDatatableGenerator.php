<?php
namespace App\Modules\Article\Http\Generator;

use App\Components\Datatable\DatatableRenderer;
use App\Components\Datatable\DatatableField;
use App\Contracts\DatatableGenerator;
use App\Modules\Article\Models\Article;
use Illuminate\Http\Request;
use Storage;
use CMS;
use Setting;

class ArticleDatatableGenerator extends DatatableGenerator
{
    public function structure(): DatatableRenderer
    {
        $structure = (new DatatableRenderer)->with([
            'title' => 'article',
            'route' => route('cms.article.datatable'),
            'batch_delete_route' => route('cms.article.delete'),
            'model' => Article::with('category'),
            'default_sort_by' => 'id',
            'default_sort_dir' => 'DESC',
            'config' => [
                (new DatatableField)->setField('title')
                    ->setLabel('Title'),
                (new DatatableField)->setField('category_id')
                    ->setLabel('Category'),
                (new DatatableField)->setField('image')
                    ->setLabel('Image')
                    ->setSearchable(false)
                    ->setOrderable(false),
                (new DatatableField)->setField('is_active')
                    ->setLabel('Status'),
                (new DatatableField)->setField('is_limited')
                    ->setLabel('Is Limited'),
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
                'category_id' => $row->category->title ?? '-',
                'image' => $row->image ? '<img src="'.Storage::url($row->image).'" style="height:30px;">' : '-',
                'is_active' => $row->is_active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Not Active</span>',
                'is_limited' => $row->is_limited ? '<span class="badge badge-info">LIMITED</span>' : '-',
                'action' => CMS::actionButton([
                    [
                        'auth' => 'cms.article.edit',
                        'html' => '<a href="'.route('cms.article.edit', ['id' => $row->id]).'" class="dropdown-item ajax-priority">
                            <i data-feather="edit-3" class="text-primary"></i>
                            <span>Edit</span>    
                        </a>',
                    ],
                    [
                        'auth' => 'cms.article.delete',
                        'html' => '<a href="#" data-target="'.route('cms.article.delete', ['id' => $row->id]).'" class="dropdown-item '.(Setting::get('general.ask_delete') ? 'delete-button' : 'btn-trigger-delete').'">
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