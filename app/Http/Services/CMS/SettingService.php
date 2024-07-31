<?php
namespace App\Http\Services\CMS;

use Illuminate\Http\Request;
use App\Base\Services\BaseService;
use App\Models\Setting as Model;
use App\Libraries\CMS;
use DB;
use Setting;

class SettingService extends BaseService
{
    public function handle(Request $request)
    {
        $setting_values = [];
        $settings = Setting::data();
        foreach ($settings as $group_key => $items) {
            foreach ($items['items'] as $item) {
                $param = $item->getName();
                $value = null;
                if (isset($request[$group_key][$param])) {
                    $value = $request[$group_key][$param];
                }

                if (empty($value)) {
                    continue;
                }

                $setting_values[] = [
                    'param' => $param,
                    'group' => $group_key,
                    'default_value' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }

        Model::truncate();
        Model::insert($setting_values);

        Setting::clearCache();

        return $this->success('Setting has been updated', null);
    }
}