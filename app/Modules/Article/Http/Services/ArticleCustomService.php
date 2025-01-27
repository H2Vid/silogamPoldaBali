<?php
namespace App\Modules\Article\Http\Services;

use App\Base\Services\BaseService;
use Illuminate\Http\Request;

class ArticleCustomService extends BaseService
{
    public function handle(Request $request)
    {
        // do something
        // return $this->error("Custom error message if fail");

        return $this->success('Process running successfully successfully');
    }
}