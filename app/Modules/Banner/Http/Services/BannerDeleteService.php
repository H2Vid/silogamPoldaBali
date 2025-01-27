<?php
namespace App\Modules\Banner\Http\Services;

use App\Base\Services\BaseDeleteService;
use Illuminate\Http\Request;
use App\Modules\Banner\Models\Banner;
use CMS;
use Exception;

class BannerDeleteService extends BaseDeleteService
{
    public function model()
    {
        // set the base model query here
        return Banner::query();
    }

    /**
     * @param $dataToBeDeleted Collection of datas to be deleted
     */
    public function verifyBeforeDelete($dataToBeDeleted)
    {
        // if ("something") {
        //     return 'Cannot delete data, some error occured banner';
        // }
        return null;
    }

    /**
     * @param $deleted_ids IDs of deleted datas
     */
    public function afterDelete($deleted_ids=[]) 
    {
        // hook after data deleted
    }

}