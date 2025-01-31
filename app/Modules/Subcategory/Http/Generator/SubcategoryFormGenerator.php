<?php
namespace App\Modules\Subcategory\Http\Generator;

use App\Components\Form\FormRenderer;
use App\Components\Form\FormField;
use App\Contracts\FormGenerator;
use App\Modules\Subcategory\Models\Subcategory;

class SubcategoryFormGenerator extends FormGenerator
{
    public function structure(): FormRenderer
    {
        $structure = (new FormRenderer)->with([
            'title' => 'subcategory',
            'model' => Subcategory::query(),
            'config' => [
                (new FormField)->setField('title')
                    ->setLabel('Title')
                    ->setType('text')
                    ->setColumn(12)
                    ->setValidation('required')
                    ->use(),
                (new FormField)->with([
                    'field' => 'description',
                    'label' => 'Description',
                    'type' => 'richtext',
                ])->use(),
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
            ],
        ]);

        return $structure;
    }
}