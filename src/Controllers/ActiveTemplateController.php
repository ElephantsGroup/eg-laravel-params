<?php

namespace ElephantsGroup\Params\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ElephantsGroup\Params\Models\Template;
use ElephantsGroup\Params\Models\ActiveTemplate;

class ActiveTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $activeTemplates = ActiveTemplate::all();
        return view('params::activeTemplate.list', ['activeTemplates' => $activeTemplates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = Template::orderBy('order')->get();
        return view('params::activeTemplate.new', ['templates' => $templates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activeTemplate = new ActiveTemplate;
        $activeTemplate->template_id = $request->template;
        $message = $activeTemplate->save() ? 'Success!' : 'Failed!';
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
        $activeTemplate = ActiveTemplate::findOrFail($id);
        return view('params::activeTemplate.show', ['activeTemplate' => $activeTemplate]);
    }
}