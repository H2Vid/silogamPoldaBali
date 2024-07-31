<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Permission;

class CmsAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('cms')->check()) {
            $user = Auth::guard('cms')->user();
            $roles = $user->roles;
            $is_sa = false;

            $roles_bawahan = [];
            foreach ($roles as $role) {
                if ($role->is_sa == 1) {
                    $is_sa = true;
                }
                $roles_bawahan = array_unique(array_merge($roles_bawahan, $this->getBawahanRole($role)));
            }

            if ($is_sa) {
                //semuanya accessible
                $accessible_role = app('role')->pluck('id')->toArray();
            } else {
                $accessible_role = $roles_bawahan;
            }

            $request->attributes->add([
                'user' => $user,
                'roles' => $roles,
                'is_sa' => $is_sa,
                'base_permission' => json_decode($role->priviledge_list, true),
                'subordinate_role' => $roles_bawahan,
                'accessible_role' => $accessible_role,
            ]);

            //check if current user have access to current route
            $route_name = $request->route()->getName();
            if (strlen($route_name) > 0) {
                if(!Permission::has($route_name)){
                    //forbidden access
                    abort(403);
                }    
            }

            return $next($request);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'type' => 'error',
                'title' => 'AuthenticationRequired',
                'message' => 'You must login first',
            ], 403);
        }
        return redirect()->route('cms.auth.login')->with([
            'error' => 'You must login first!'
        ]);
    }

    protected function getBawahanRole($role, $data = [])
    {
        $role = app('role')->find($role->id);
        $data[] = $role->id;
        if ($role->children->count() > 0) {
            foreach ($role->children as $child) {
                $data = $this->getBawahanRole($child, $data);
            }
        }
        return array_unique($data);
    }
}
