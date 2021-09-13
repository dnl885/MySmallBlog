<?php

namespace App\Http\Controllers\Admin\AppDefault;

use \App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function index(){
        return view('admin.index');
    }

}
