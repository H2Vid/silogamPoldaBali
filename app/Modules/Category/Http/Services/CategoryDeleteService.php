<?php
namespace App\Modules\Category\Http\Services;

use App\Base\Services\BaseDeleteService;
use Illuminate\Http\Request;
use App\Modules\Category\Models\Category;
use CMS;
use Exception;

class CategoryDeleteService extends BaseDeleteService
{
    public function model()
    {
        // set the base model query here
        return Category::query();
    }

    /**
     * @param $dataToBeDeleted Collection of datas to be deleted
     */
    public function verifyBeforeDelete($dataToBeDeleted)
    {
        // if ("something") {
        //     return 'Cannot delete data, some error occured category';
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