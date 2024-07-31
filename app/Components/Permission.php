<?php
namespace App\Components;


class Permission
{
    public function __construct()
    {
        $this->config = config('permission');
        $this->roles = $this->getCurrentRoles();
    }

    public function all()
    {
        return $this->config;
    }

    public function lists()
    {
        $out = [];
        foreach ($this->config as $group => $lists) {
            foreach ($lists as $sub => $items) {
                $out = array_merge($out, $items);
            }
        }
        return array_unique($out);
    }

    public function has($permission_key = null, $role = null)
    {
        if (in_array($permission_key, $this->lists())) {
            foreach ($this->roles as $role) {
                if ($role->is_sa) {
                    //superadmin selalu punya akses ke segala halaman
                    return true;
                } else {
                    // cek permission role ybs
                    $current_role_permissions = json_decode($role->priviledge_list, true);
                    if ($current_role_permissions) {
                        //return true if has permission, and return false if not have permission
                        if (in_array($permission_key, $current_role_permissions)) {
                            return true;
                        }
                    }
                }
            }
            // user has no access to this defined route
            return false;
        }

        //if permission is not in config lists, then everyone can access
        return true;
    }

    protected function getCurrentRoles($role_ids = [])
    {
        if ($role_ids) {
            return app('role')->whereIn('id', $role_ids)->get();
        } else {
            return request()->get('roles');
        }
    }
}
