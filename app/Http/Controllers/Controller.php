<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $request;

    public function __construct(Request $request) 
    {
        $this->request = $request;
    }

    // shortcode POST do-something via service
    protected function handleService($request, $service, ...$param)
    {
        $resp = $service->handle($request, ...$param);
        return $this->handleResponse($resp);
    }

    // handleResponse will return a redirect / json response based on current request context
    protected function handleResponse($resp=[])
    {
        $redirect_url = $resp['redirect'] ?? null;
        $type = $resp['type'] ?? null;
        $message = $resp['message'] ?? null;

        $http_code = 200;
        if ($type == 'error') {
            $http_code = 500;
        }
        if (isset($resp['http_code'])) {
            $http_code = $resp['http_code'];
        }

        $expect_json = $this->request->expectsJson();
        if ($expect_json) {
            return response()->json($resp, $http_code);
        }

        $redir_pass = [
            $type => $message,
        ];
        foreach ($resp as $fld => $val) {
            if (!in_array($fld, ['type', 'message', 'redirect'])) {
                $redir_pass[$fld] = $val;
            }
        }
        if ($redirect_url) {
            return redirect($redirect_url)->with($redir_pass)->withInput();
        }
        return redirect()->back()->with($redir_pass)->withInput();
    }
}
