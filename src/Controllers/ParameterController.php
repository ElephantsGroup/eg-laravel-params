<?php

namespace ElephantsGroup\Params\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ElephantsGroup\Params\Models\Parameter;
use ElephantsGroup\Params\Models\Unit;
use ElephantsGroup\Params\Models\ActiveParameter;
use ElephantsGroup\Params\Models\Template;

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
            $parameters = Parameter::all()->where('status', Parameter::STATUS_ENABLED);
        else
            $parameters = Parameter::all()->where('status', Parameter::STATUS_DISABLED);
        return view('params::parameter.list', ['parameters' => $parameters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::orderBy('order')->get();
        return view('params::parameter.new', ['units' => $units]);
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
        $parameter->status = ($request->enabled ? Parameter::STATUS_ENABLED : Parameter::STATUS_DISABLED);
        $parameter->unit_id = $request->unit;
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
        $activations = [];

        $activeParameters = ActiveParameter::select('placeholder', 'template_id', DB::raw('MAX(created_at)'))
            ->groupBy('parameter_id', 'placeholder', 'template_id')
            ->having('parameter_id', '=', $id)
            ->whereNotNull('template_id')
            ->get();
        foreach ($activeParameters as $activeParameter)
            $activations[$activeParameter->placeholder] = Template::findOrFail($activeParameter->template_id);

        $activeParameters = ActiveParameter::select('placeholder', DB::raw('MAX(created_at)'))
            ->groupBy('parameter_id', 'placeholder')
            ->having('parameter_id', '=', $id)
            ->whereNull('template_id')
            ->get();
        foreach ($activeParameters as $activeParameter)
            if (!isset($activations[$activeParameter->placeholder]))
                $activations[$activeParameter->placeholder] = NULL;
 
        return view('params::parameter.show', ['parameter' => $parameter, 'activations' => $activations]);
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
        $units = Unit::orderBy('order')->get();
        return view('params::parameter.edit', ['parameter' => $parameter, 'units' => $units]);
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
        $parameter->unit_id = $request->unit;
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