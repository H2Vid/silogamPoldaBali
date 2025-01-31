<?php
namespace App\Modules\Subcategory\Http\Services;

use App\Base\Services\BaseCrudService;
use Illuminate\Http\Request;
use App\Modules\Subcategory\Http\Generator\SubcategoryFormGenerator;
use App\Modules\Subcategory\Models\Subcategory;

class SubcategoryCrudService extends BaseCrudService
{
    public function structure($id=null)
    {
        $form = (new SubcategoryFormGenerator)->getStructure();
        if ($id) {
            $form->setData(Subcategory::findOrFail($id));
        } else {
            $form->setData(new Subcategory);
        }
        return $form;
    }

    public function beforeCrud(Request $request, $instance)
    {
        return $instance;
    }

    public function afterCrud(Request $request, $instance)
    {
        // hook after successfully create/update data
    }

    public function successRedirectTarget()
    {
        return route('cms.subcategory.index');
    }

    public function successRedirectMessage()
    {
        return 'Data has been saved successfully';
    }
}
