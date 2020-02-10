<?php

namespace ElephantsGroup\Params\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*if (auth()->user()->hasRole('params-reporter'))
            return redirect('/params/value');*/
        return view('params::index');
    }
}