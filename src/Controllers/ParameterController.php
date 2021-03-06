<?php

namespace ElephantsGroup\Params\Controllers;

use App\Http\Controllers\Controller;
use Carbon;
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
            $parameters = Parameter::paginate(10);
        else if ('enabled' === $show)
            $parameters = Parameter::where('status', Parameter::STATUS_ENABLED)->paginate(10);
        else
            $parameters = Parameter::where('status', Parameter::STATUS_DISABLED)->paginate(10);
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

        $today = Carbon\Carbon::today();
        $stats = [];

        $count = 0;
        $sum = 0;
        foreach ($parameter->latestValues as $value)
        {
            if (count($stats) == 7)
                break;
            if ($value->created_at->isSameDay($today))
            {
                $count++;
                $sum += $value->value;
            }
            else
            {
                if ($count == 0)
                    $stats[] = [ 'date' => $today->format('M d'), 'value' => null ];
                else
                    $stats[] = [ 'date' => $today->format('M d'), 'value' => $sum / $count ];
                $today->subDay();
                while (count($stats) < 7 && !$value->created_at->isSameDay($today))
                {
                    $stats[] = [ 'date' => $today->format('M d'), 'value' => null ];
                    $today->subDay();
                }
                $count = 1;
                $sum = $value->value;
            }
        }
        if (count($stats) < 7)
        {
            if ($count == 0)
                $stats[] = [ 'date' => $today->format('M d'), 'value' => null ];
            else
                $stats[] = [ 'date' => $today->format('M d'), 'value' => $sum / $count ];
            for ($i = count($stats); $i < 7; $i++)
            {
                $today->subDay();
                $stats[] = [ 'date' => $today->format('M d'), 'value' => null ];
            }
        }
 
        $interpolated = $stats;
        $firstNotNullIndex = -1;
        for ($i = 0; $i < count($interpolated); $i++)
        {
            if ($interpolated[$i]['value'] === NULL)
            {
                if ($firstNotNullIndex < $i)
                {
                    $firstNotNullIndex = $i+1;
                    while ($firstNotNullIndex < count($interpolated) && $interpolated[$firstNotNullIndex]['value'] === NULL)
                        $firstNotNullIndex++;
                }
                if ($firstNotNullIndex === count($interpolated))
                    break;
                if ($i === 0)
                {
                    $i = $firstNotNullIndex + 1;
                    continue;
                }
                else
                    $interpolated[$i]['value'] = $interpolated[$i-1]['value'] + ($interpolated[$firstNotNullIndex]['value'] - $interpolated[$i-1]['value'])/($firstNotNullIndex - $i + 1);
            }
        }

        return view('params::parameter.show', [
            'parameter' => $parameter,
            'activations' => $activations,
            'stats' => array_reverse($stats),
            'interpolated' => array_reverse($interpolated)
        ]);
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