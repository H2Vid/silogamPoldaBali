<?php
namespace App\Components;

class RoleStructure
{
    public $structured_role;
    public $role_list;
    public $dropdown_list;
    public $dropdown_risk_limit_list;
    public $array_only;

    public function __construct($current_user = null)
    {
        if (empty($current_user)) {
            $current_user = request()->get('user')->roles;
        }

        $this->structured_role = $this->structuredRole($current_user);
        $this->structured_role = $this->sortStructuredRole($this->structured_role);
        $this->role_list = [];
        $this->generateRoleList();
        $this->generateDropdownList();
        $this->generateArrayOnly();
    }

    public function sortStructuredRole($item = [])
    {
        if (isset($item['children'])) {
            ksort($item['children']);
            foreach ($item['children'] as $id => $row) {
                $item['children'][$id] = $this->sortStructuredRole($row);
            }
        }
        return $item;
    }

    public function structuredRole($current_roles = [])
    {
        $base_role = app('role')->whereNull('role_owner');
        $is_sa = false;
        $sa_role = null;
        $current_ids = [];

        foreach ($current_roles as $role) {
            $current_ids[] = $role->id;
            if ($role->is_sa == 1) {
                $is_sa = true;
                $sa_role = $role;
            }
        }


        $out = [];
        foreach ($base_role as $row) {
            $out[$row->id] = $this->handleLoopStructure($row);
        }

        if (!$is_sa) {
            //ambil hanya berdasarkan id yg ditemukan
            $temporary_out = [];
            foreach ($out as $first) {
                $value = $this->returnCurrentRoleOnly($first, $current_ids);
                if ($value) {
                    return $value;
                }
            }
        } else {
            //if as super admin, $out with index [current_super_admin] will be removed
            $final = [];
            foreach ($out as $o) {
                if (!$o['is_sa']) {
                    $final[] = $o;
                }
            }

            return [
                'id' => $sa_role->id,
                'label' => $sa_role->name,
                'priviledge' => json_decode($sa_role->priviledge, true),
                'role_owner' => true,
                'is_sa' => 1,
                'children' => $final
            ];
        }

    }

    protected function returnCurrentRoleOnly($out, $stop_ids=[])
    {
        if (in_array($out['id'], $stop_ids)) {
            return $out;
        }
        if (isset($out['children'])) {
            foreach ($out['children'] as $child) {
                $grabbed = $this->returnCurrentRoleOnly($child, $stop_id);
                if ($grabbed) {
                    return $grabbed;
                }
            }
        }
    }

    protected function handleLoopStructure($row, $data = [])
    {
        //ambil data dari singleton biar ga banyak koneksi database
        $row = app('role')->where('id', $row->id)->first();

        $data = [
            'id' => $row->id,
            'label' => $row->name,
            'priviledge' => json_decode($row->priviledge_list, true),
            'role_owner' => $row->role_owner,
            'is_sa' => $row->is_sa,
            'priviledge_list' => $row->getPermissionList(),
        ];
        if ($row->children->count() > 0) {
            foreach ($row->children as $child) {
                $data['children'][$child->id] = $this->handleLoopStructure($child, $data);
            }
        }
        return $data;
    }

    public function generateRoleList()
    {
        $this->extractStructureData($this->structured_role);
        return $this->role_list;
    }

    protected function extractStructureData($arr, $i = 0, $upgrade_level = true)
    {
        if (isset($arr['id']) && isset($arr['label'])) {
            $this->role_list[] = [
                'id' => $arr['id'],
                'is_sa' => isset($arr['is_sa']) ? $arr['is_sa'] : 0,
                'label' => $arr['label'],
                'level' => $i,
                'role_owner' => isset($arr['role_owner']) ? $arr['role_owner'] : null,
                'priviledge_list' => $arr['priviledge_list'] ?? [],
            ];
        }

        if ($upgrade_level) {
            $i++;
        }

        if (isset($arr['children'])) {
            $n = 0;
            foreach ($arr['children'] as $child) {
                $n++;
                $up = true;
                $this->extractStructureData($child, $i, $up);
            }
        }
    }

    public function generateDropdownList()
    {
        $this->dropdown_list = [];
        foreach ($this->role_list as $row) {
            $this->dropdown_list[$row['id']] = str_repeat('*', $row['level']) . $row['label'];
        }
    }

    public function getLevel($role_id)
    {
        $collect = collect($this->role_list);
        $get = $collect->where('id', $role_id);
        if ($get->count() > 0) {
            $grab = $get->first();
            return $grab['level'];
        }
    }

    public function generateArrayOnly()
    {
        $out = [];
        foreach ($this->role_list as $list) {
            $out[] = $list['id'];
        }
        $this->array_only = $out;
        return $out;
    }

}
