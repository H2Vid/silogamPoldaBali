<?php
namespace App\Modules\Article\Http\Generator;

use App\Components\Form\FormRenderer;
use App\Components\Form\FormField;
use App\Contracts\FormGenerator;
use App\Modules\Article\Models\Article;
use App\Modules\Category\Models\Category;

class ArticleFormGenerator extends FormGenerator
{
    public function structure(): FormRenderer
    {
        $structure = (new FormRenderer)->with([
            'title' => 'article',
            'model' => Article::query(),
            'config' => [
                (new FormField)->setField('title')
                    ->setLabel('Title')
                    ->setType('text')
                    ->setColumn(12)
                    ->setValidation('required')
                    ->use(),
                (new FormField)->with([
                    'field' => 'excerpt',
                    'label' => 'Short Description',
                    'type' => 'textarea',
                    'attr' => [
                        'maxlength' => 300
                    ]
                ])->use(),
                (new FormField)->with([
                    'field' => 'description',
                    'label' => 'Description',
                    'type' => 'richtext',
                ])->use(),
                (new FormField)->with([
                    'field' => 'category_id',
                    'label' => 'Category',
                    'type' => 'select',
                    'validation' => 'required',
                    'lists' => function() {
                        return Category::where('is_active', true)->get(['id', 'title'])->pluck('title', 'id')->toArray();
                    }
                ]),
                (new FormField)->with([
                    'field' => 'image',
                    'label' => 'Image',
                    'type' => 'image',
                    'column' => 4,
                    'notes' => 'Please upload with JPG/PNG format maximum 1MB '
                ])->use(),
                (new FormField)->with([
                    'field' => 'is_active',
                    'label' => 'Is Active',
                    'type' => 'yesno',
                    'column' => 4,
                ])->use(),
                (new FormField)->with([
                    'field' => 'is_limited',
                    'label' => 'Is Limited',
                    'type' => 'yesno',
                    'column' => 4,
                ])->use(),
            ],
        ]);

        return $structure;
    }

}