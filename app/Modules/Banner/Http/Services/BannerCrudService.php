<?php
namespace App\Modules\Banner\Http\Services;

use App\Base\Services\BaseCrudService;
use Illuminate\Http\Request;
use App\Modules\Banner\Http\Generator\BannerFormGenerator;
use App\Modules\Banner\Models\Banner;

class BannerCrudService extends BaseCrudService
{
    public function structure($id=null)
    {
        $form = (new BannerFormGenerator)->getStructure();
        if ($id) {
            $form->setData(Banner::findOrFail($id));
        } else {
            $form->setData(new Banner);
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
        return route('cms.banner.index');
    }

    public function successRedirectMessage()
    {
        return 'Data has been saved successfully';
    }

}