<?php

namespace ElephantsGroup\Params\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ElephantsGroup\Params\Parameter;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $show = config('params.defaultListMode', 'enabled');
        if (!in_array($show, ['enabled', 'disabled', 'all']))
            $show = 'enabled';
        $showQuery = $request->query('show');
        if ($showQuery && (in_array($showQuery, ['enabled', 'disabled', 'all'])))
            $show = $showQuery;
        if ('all' === $show)
            $parameters = Parameter::all();
        else if ('enabled' === $show)
            $parameters = Parameter::all()->where('status', Parameter::_STATUS_ENABLED);
        else
            $parameters = Parameter::all()->where('status', Parameter::_STATUS_DISABLED);
        return view('params::parameter.list', ['parameters' => $parameters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('params::parameter.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parameter = new Parameter;
        $parameter->name = $request->name;
        $parameter->description = $request->description;
        $parameter->status = ($request->enabled ? Parameter::_STATUS_ENABLED : Parameter::_STATUS_DISABLED);
        $parameter->unit = $request->unit;
        $message = $parameter->save() ? 'Success!' : 'Failed!';
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
        $parameter = Parameter::findOrFail($id);
        return view('params::parameter.show', ['parameter' => $parameter]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $parameter = Parameter::findOrFail($id);
        return view('params::parameter.edit', ['parameter' => $parameter]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $parameter = Parameter::findOrFail($id);
        $parameter->name = $request->name;
        $parameter->description = $request->description;
        $parameter->unit = $request->unit;
        $message = $parameter->save() ? 'Success!' : 'Failed!';
        return redirect()->back()->withInput($request->all())->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $parameter = Parameter::findOrFail($id);
        $message = "Deleting parameter #$id" . ($parameter->delete() ? ' Succeed!' : ' Failed!');
        return redirect()->to('/params/parameter')->withInput($request->all())->with('message', $message);
    }

    public function enable($id)
    {
        $parameter = Parameter::findOrFail($id);
        $parameter->enable();
        $parameter->save();
        return redirect()->back()->with('message', 'Success!');
    }

    public function disable($id)
    {
        $parameter = Parameter::findOrFail($id);
        $parameter->disable();
        $parameter->save();
        return redirect()->back()->with('message', 'Success!');
    }
}