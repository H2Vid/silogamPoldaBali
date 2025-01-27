<?php
namespace App\Modules\Article\Http\Services;

use App\Base\Services\BaseCrudService;
use Illuminate\Http\Request;
use App\Modules\Article\Http\Generator\ArticleFormGenerator;
use App\Modules\Article\Models\Article;
use Storage;

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
        $pdfs = [];
        if ($request->pdfs && is_array($request->pdfs)) {
            foreach ($request->pdfs as $pdf) {
                if ($pdf && Storage::exists($pdf)) {
                    $pdfs[] = $pdf;
                }
            }
        }

        $instance->pdfs = json_encode($pdfs);

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