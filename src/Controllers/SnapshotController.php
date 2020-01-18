<?php

namespace ElephantsGroup\Params\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ElephantsGroup\Params\Models\Template;
use ElephantsGroup\Params\Models\ActiveTemplate;
use ElephantsGroup\Params\Models\Parameter;
use ElephantsGroup\Params\Models\ActiveParameter;
use ElephantsGroup\Params\Models\Unit;
use ElephantsGroup\Params\Models\Value;
use ElephantsGroup\Params\Models\TemplateSnapshot;

class SnapshotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $snapshots = TemplateSnapshot::all();
        return view('params::snapshot.list', ['snapshots' => $snapshots]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $snapshot = new TemplateSnapshot;
        $activeTemplate = ActiveTemplate::latest()->first();
        if ($activeTemplate)
            $snapshot->content = $activeTemplate->template->content;
        else
            return redirect()->back()->withInput($request->all())->with('message', 'No active template!');

        $activeParameters = ActiveParameter::select('placeholder', 'parameter_id', DB::raw('MAX(created_at)'))
            ->groupBy('placeholder', 'parameter_id')
            ->where(['template_id' => $activeTemplate->template->id])
            ->get();
        foreach ($activeParameters as $activeParameter)
        {
            $parameter = Parameter::findOrFail($activeParameter->parameter_id);
            if (count($parameter->currentValue) > 0)
                $snapshot->content = str_replace($activeParameter->placeholder, $parameter->currentValue[0]->value, $snapshot->content);
        }

        $activeParameters = ActiveParameter::select('placeholder', 'parameter_id', DB::raw('MAX(created_at)'))
            ->groupBy('placeholder', 'parameter_id')
            ->whereNull('template_id')
            ->get();
        foreach ($activeParameters as $activeParameter)
        {
            $parameter = Parameter::findOrFail($activeParameter->parameter_id);
            if (count($parameter->currentValue) > 0)
                $snapshot->content = str_replace($activeParameter->placeholder, $parameter->currentValue[0]->value, $snapshot->content);
        }

        $message = $snapshot->save() ? 'Success!' : 'Failed!';
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
        $snapshot = TemplateSnapshot::findOrFail($id);
        return view('params::snapshot.show', ['snapshot' => $snapshot]);
    }
}