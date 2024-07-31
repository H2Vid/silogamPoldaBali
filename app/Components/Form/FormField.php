<?php
namespace App\Components\Form;

use App\Libraries\DynamicProperty;
use Exception;
use Input;
use View;

class FormField
{
    use DynamicProperty;

    public $field;
    public $label;
    public $type = 'text';
    public $column = 12;
    public $attr = [];
    public $validation = null;
    public $validation_message = [];
    public $tab_group = 'default';
    public $lists;
    public $view_source = null;
    public $value = null;
    public $hide_label = false;
    public $hide_on_update = false;
    public $translateable = false;
    public $input_array = false;
    public $notes = '';

    public function use()
    {
        // check if current inputted data is valid or not. 
        // will throw Exception if not valid
        if (empty($this->field)) {
            throw new Exception("\"field\" parameter in FormField is required");
        }
        if (empty($this->label)) {
            throw new Exception("\"label\" parameter in FormField is required");
        }

        if ($this->type == 'view') {
            if (!View::exists($this->view_source)) {
                throw new Exception("View \"".$this->view_source."\" in FormField is not exists");
            }
        } else {
            try {
                $try_input = Input::call($this->type);
            } catch (Exception $e) {
                throw new Exception("Invalid or unknown input type \"".$this->type."\"");
            }
    
            if (in_array($this->type, ['selectMultiple', 'checkbox', 'radio'])) {
                $lists = $this->lists ?? [];
                if (empty($lists)) {
                    throw new Exception("\"lists\" parameter in FOrmField is required for multiple input type such as selectMultiple, checkbox, and radio");
                }
                if (!is_array($lists) && !is_callable($lists)) {
                    throw new Exception("\"lists\" in FormField must be in array format");
                }
            }    
        }

        if (intval($this->column) <= 0 || intval($this->column) > 12) {
            $this->column = 12;
        }

        return $this;
    }

    // helper
    public function isMandatory()
    {
        return strpos($this->validation, 'required') !== false;
    }
}