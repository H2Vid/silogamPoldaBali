<?php
namespace App\Modules\Subcategory\Http\Services;

use App\Base\Services\BaseService;
use Illuminate\Http\Request;

class SubcategoryCustomService extends BaseService
{
    public function handle(Request $request)
    {
        return $this->success('Process running successfully');
    }
}