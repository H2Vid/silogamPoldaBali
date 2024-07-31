<?php
namespace App\Components;

use Exception;

class Input 
{
    // AUTO BUILDER CALLER
    public function call($type, $params=[])
    {
        if (method_exists($this, $type)) {
            $input = $this->$type();

            foreach ($params as $key => $value) {
                if ($key == 'attr') {
                    $attr = $input->getAttr();
                    $input->setAttr(array_merge($attr ?? [], $value));
                } else {
                    $input->$key = $value;
                }
            }
            return $input->build();
        }

        throw new Exception("Input caller with type '".$type."' is not found or undefined");
    }
    

    /**
     * MANUAL CALLER
     */

    public function text()
    {
        return new Input\Text();
    }

    public function number()
    {
        return (new Input\Text())->setType('number');
    }

    public function email()
    {
        return (new Input\Text())->setType('email');
    }

    public function color()
    {
        return (new Input\Text())->setType('color');
    }

    public function tags()
    {
        return (new Input\Text())->setAttr([
            'data-role' => 'tagsinput'
        ]);
    }

    public function date()
    {
        return (new Input\Text())->setData('data-datetimepicker');
    }

    public function datetime()
    {
        return (new Input\Text())->setData('data-datetimepicker data-timepicker-second');
    }

    public function daterange()
    {
        return (new Input\Text())->setData('data-datetimepicker data-daterange');
    }

    public function time()
    {
        return (new Input\Text())->setData('data-timepicker');
    }

    public function textarea()
    {
        return new Input\Textarea();
    }

    public function richtext()
    {
        return (new Input\Textarea())->setData('data-richtext');
    }
    
    public function password()
    {
        return new Input\Password();
    }

    public function select()
    {
        return new Input\Select();
    }

    public function selectMultiple()
    {
        return (new Input\Select())->setIsMultiple(true);
    }    

    public function checkbox()
    {
        return new Input\Checkbox();
    }

    public function radio()
    {
        return (new Input\Checkbox())->setType('radio');
    }

    public function image()
    {
        return new Input\Image();
    }

    public function file()
    {
        return new Input\File();
    }

    public function yesno()
    {
        return new Input\Yesno();
    }
}