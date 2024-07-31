<?php
namespace App\Modules\Article\Http\Services;

use App\Base\Services\BaseCrudService;
use Illuminate\Http\Request;
use App\Modules\Article\Http\Generator\ArticleFormGenerator;
use App\Modules\Article\Models\Article;

class ArticleCrudService extends BaseCrudService
{
    public function structure($id=null)
    {
        $form = (new ArticleFormGenerator)->getStructure();
        if ($id) {
            $form->setData(Article::findOrFail($id));
        } else {
            $form->setData(new Article);
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
        return route('cms.article.index');
    }

    public function successRedirectMessage()
    {
        return 'Data has been saved successfully';
    }

}