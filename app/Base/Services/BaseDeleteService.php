<?php
namespace App\Base\Services;

use Illuminate\Http\Request;
use CMS;
use Exception;

class BaseDeleteService extends BaseService
{

    public function handle(Request $request, $id=null)
    {
        if (!method_exists($this, 'model')) {
            throw new Exception("Invalid delete service class. No model method defined");
        }

        $data = $this->model();
        $pk = CMS::getPrimaryKeyField($data);
        
        if ($id) {
            $grabbed = $data->where($pk, $id)->get();
        }
        if (is_array($request->list_id)) {
            $grabbed = $data->whereIn($pk, $request->list_id)->get();
        }
        
        if ($grabbed->count() == 0) {
            return $this->error('Data to be deleted is not found', null, 400);
        }
        if (method_exists($this, 'verifyBeforeDelete')) {
            $err = $this->verifyBeforeDelete($grabbed);
            if (strlen($err) > 0) {
                return $this->error($err, null, 400);
            }
        }

        $deleted_ids = $grabbed->pluck($pk)->toArray();
        $data->whereIn($pk, $deleted_ids)->delete();

        $is_translateable = false;
        $translate_model = null;
        if (method_exists($data, 'getModel')) {
            $mdl = $data->getModel();
            if (method_exists($mdl, 'isTranslateable')) {
                $is_translateable = $mdl->isTranslateable();
                $translate_model = $mdl->translate_model;
            }
        } else if (method_exists($data, 'isTranslateable')) {
            $is_translateable = $data->isTranslateable();
            $translate_model = $data->translate_model;
        } 

        if ($is_translateable && !empty($translate_model)) {
            // remove the translation data too
            app($translate_model)->whereIn('main_id', $deleted_ids)->delete();
        }

        if (method_exists($this, 'afterDelete')) {
            $this->afterDelete($deleted_ids);
        }

        return $this->success('Data has been deleted successfully');
    }
}