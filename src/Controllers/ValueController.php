<?php

namespace ElephantsGroup\Params\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ElephantsGroup\Params\Models\Parameter;
use ElephantsGroup\Params\Models\Value;

class ValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $values = Value::latest()->paginate(10);
        return view('params::value.list', ['values' => $values]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parameters = Parameter::orderBy('order')->get();
        return view('params::value.new', ['parameters' => $parameters]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $value = new Value;
        $value->value = $request->value;
        $value->parameter_id = $request->parameter;
        $message = $value->save() ? 'Success!' : 'Failed!';
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
        $value = Value::findOrFail($id);
        return view('params::value.show', ['value' => $value]);
    }
}