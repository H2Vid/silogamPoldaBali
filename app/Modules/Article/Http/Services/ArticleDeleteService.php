<?php
namespace App\Modules\Article\Http\Services;

use App\Base\Services\BaseDeleteService;
use Illuminate\Http\Request;
use App\Modules\Article\Models\Article;
use CMS;
use Exception;

class ArticleDeleteService extends BaseDeleteService
{
    public function model()
    {
        // set the base model query here
        return Article::query();
    }

    /**
     * @param $dataToBeDeleted Collection of datas to be deleted
     */
    public function verifyBeforeDelete($dataToBeDeleted)
    {
        // if ("something") {
        //     return 'Cannot delete data, some error occured article';
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