<?php
namespace App\Modules\Subcategory\Http\Services;

use App\Base\Services\BaseDeleteService;
use Illuminate\Http\Request;
use App\Modules\Subcategory\Models\Subcategory;
use CMS;
use Exception;

class SubcategoryDeleteService extends BaseDeleteService
{
    public function model()
    {
        return Subcategory::query();
    }

    public function verifyBeforeDelete($dataToBeDeleted)
    {
        return null;
    }

    public function afterDelete($deleted_ids=[])
    {
        // hook after data deleted
    }
}
