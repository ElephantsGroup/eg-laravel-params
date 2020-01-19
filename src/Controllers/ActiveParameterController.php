<?php

namespace ElephantsGroup\Params\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ElephantsGroup\Params\Models\Parameter;
use ElephantsGroup\Params\Models\ActiveParameter;
use ElephantsGroup\Params\Models\Template;

class ActiveParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $activeParameters = ActiveParameter::latest()->get();
        return view('params::activeParameter.list', ['activeParameters' => $activeParameters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parameters = Parameter::orderBy('order')->get();
        $templates = Template::orderBy('order')->get();
        return view('params::activeParameter.new', ['parameters' => $parameters, 'templates' => $templates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activeParameter = new ActiveParameter;
        $activeParameter->placeholder = $request->placeholder;
        $activeParameter->parameter_id = $request->parameter;
        $activeParameter->template_id = $request->template;
        $message = $activeParameter->save() ? 'Success!' : 'Failed!';
        return redirect()->back()->withInput($request->all())->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activeParameter = ActiveParameter::findOrFail($id);
        return view('params::activeParameter.show', ['activeParameter' => $activeParameter]);
    }
}