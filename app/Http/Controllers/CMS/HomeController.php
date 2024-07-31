<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('cms.index', [
            'title' => 'Dashboard'
        ]);
    }
}