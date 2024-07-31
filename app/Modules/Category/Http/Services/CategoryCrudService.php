<?php
namespace App\Modules\Category\Http\Services;

use App\Base\Services\BaseCrudService;
use Illuminate\Http\Request;
use App\Modules\Category\Http\Generator\CategoryFormGenerator;
use App\Modules\Category\Models\Category;

class CategoryCrudService extends BaseCrudService
{
    public function structure($id=null)
    {
        $form = (new CategoryFormGenerator)->getStructure();
        if ($id) {
            $form->setData(Category::findOrFail($id));
        } else {
            $form->setData(new Category);
        }
        return $form;
    }

    public function beforeCrud(Request $request, $instance)
    {
        // return $this->error('can still return error and no data created/updated yet', null, 400);
        return $instance;
    }

    public function afterCrud(Request $request, $instance)
    {
        // hook after successfully create/update data
    }

    public function successRedirectTarget()
    {
        return route('cms.category.index');
    }

    public function successRedirectMessage()
    {
        return 'Data has been saved successfully';
    }

}