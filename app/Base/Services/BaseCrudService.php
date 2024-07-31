<?php
namespace App\Base\Services;

use Illuminate\Http\Request;
use Validator;
use CMS;

class BaseCrudService extends BaseService
{

    public function handle(Request $request, $id=null) 
    {
        $structure = $this->structure($id);
        $this->id = null;
        $this->mode = 'store';
        $data = $structure->getData();
        $pk = CMS::getPrimaryKeyField($data);
        if (isset($data->{$pk})) {
            $this->mode = 'update';
            $this->id = $data->{$pk};
        }

        $is_translateable = false;
        if (method_exists($data, 'isTranslateable')) {
            $is_translateable = $data->isTranslateable();
        }

        $is_seoable = false;
        if (method_exists($data, 'isSeoable')) {
            $is_seoable = $data->isSeoable();
        }

        $translation_fillable = [];
        if ($is_translateable) {
            $translation_fillable = $data->translatorInstance()->getFillable();
        }

        $default_language = CMS::defaultLang();
        $seo_data = [];
        $seo_language_data = [];

        $err = $this->validateGenerator($request, $structure);
        if ($err) {
            return $err;
        }

        $structure_config = $structure->getConfig();
        if ($is_seoable) {
            $structure_config = array_merge($structure_config, $data->seoConfig());
        }

        $pass = [];
        $langpass = [];
        foreach ($structure_config as $config) {
            // skip logic
            if ($config->getHideOnUpdate() && $this->mode == 'update') {
                continue;
            }

            if ($config->getTabGroup() == 'seo') {
                $seo_field = preg_replace('/seo\[(.*?)\]/', '$1', $config->getField());
                if (strlen($seo_field) && isset($request->seo[$seo_field])) {
                    $seo_value = $request->seo[$seo_field];
                    if (is_array($seo_value)) {
                        $seo_value = $seo_value[$default_language] ?? null;
                    }

                    foreach (CMS::langs() as $langcode => $langdata) {
                        $langvalue = $request->seo[$seo_field][$langcode] ?? $seo_value;
                        $seo_language_data[$langcode][$seo_field] = $langvalue;
                    }

                    $seo_data[$seo_field] = $seo_value;
                }
                continue;
            }

            if ($is_translateable && array_key_exists($config->getField(), $request->all())) {
                if (is_array($request->{$config->getField()}) && array_key_exists(CMS::defaultLang(), $request->{$config->getField()})) {
                    $val = $request->{$config->getField()}[CMS::defaultLang()] ?? null;
                } else {
                    $val = $request->{$config->getField()} ?? null;
                }
            } else {
                $val = $request->{$config->getField()} ?? null;
            }

            if (in_array($config->getField(), $this->fillables)) {
                $pass[$config->getField()] = $val;
            }
            if (in_array($config->getField(), $translation_fillable)) {
                foreach (CMS::langs() as $langcode => $langdata) {
                    $langvalue = $request->{$config->getField()}[$langcode] ?? ($request->{$config->getField()}[CMS::defaultLang()] ?? null);
                    $langpass[$langcode][$config->getField()] = $langvalue;
                }
            }
        }
        
        foreach ($pass as $key => $value) {
            $data->{$key} = $value;
        }

        if ($is_seoable) {
            $data->seo = json_encode($seo_data);
            if ($is_translateable) {
                foreach ($langpass as $langcode => $langdata) {
                    $langpass[$langcode]['seo'] = json_encode($seo_language_data[$langcode] ?? $seo_data);
                }    
            }
        }

        if (method_exists($data, 'slugify')) {
            $data = $data->slugify($request->slug_master);
        }

        $data = $this->beforeCrud($request, $data);
        if (is_array($data)) {
            if (isset($data['type'])) {
                // if there are error occured
                return $data;
            }
        }
        $data->save();

        // store language data if exists
        if (!empty($langpass)) {
            $data->storeTranslate($langpass);
        }

        $this->afterCrud($request, $data);

        return $this->success($this->successRedirectMessage(), $this->successRedirectTarget());
    }

    protected function validateGenerator(Request $request, $structure) 
    {
        $rules = [];
        $messages = [];
        $this->fillables = CMS::getFillables($structure->getModel());
        if (empty($this->fillables)) {
            return $this->error("You must set the model fillable first", null, 500);
        }
        
        foreach ($structure->getConfig() as $config) {
            // skip logic
            if ($config->getHideOnUpdate() && $this->mode == 'update') {
                continue;
            }

            if ($config->getValidation()) {
                $validation = str_replace('[id]', ($this->id ?? '0'), $config->getValidation());
                $field = $config->getField();
                if ($config->getTranslateable()) {
                    $field .= '.' . CMS::defaultLang();
                }
                $rules[$field] = $validation;
                if (!empty($config->getValidationMessage())) {
                    $messages = array_merge($messages, $config->getValidationMessage());
                }
            }
        }

        $validate = Validator::make($request->all(), $rules, $messages);
        if ($validate->fails()) {
            return $this->error($validate->errors()->first(), null, 400);
        }
    }
}