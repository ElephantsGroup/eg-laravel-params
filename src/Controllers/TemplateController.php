<?php

namespace ElephantsGroup\Params\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ElephantsGroup\Params\Models\Template;
use ElephantsGroup\Params\Models\Parameter;

class TemplateController extends Controller
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
            $templates = Template::all();
        else if ('enabled' === $show)
            $templates = Template::all()->where('status', Template::STATUS_ENABLED);
        else
            $templates = Template::all()->where('status', Template::STATUS_DISABLED);
        return view('params::template.list', ['templates' => $templates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('params::template.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template = new Template;
        $template->name = $request->name;
        $template->content = $request->content;
        $template->status = ($request->enabled ? Template::STATUS_ENABLED : Template::STATUS_DISABLED);
        $message = $template->save() ? 'Success!' : 'Failed!';
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
        $template = Template::findOrFail($id);
        return view('params::template.show', ['template' => $template]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $template = Template::findOrFail($id);
        return view('params::template.edit', ['template' => $template]);
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
        $template = Template::findOrFail($id);
        $template->name = $request->name;
        $template->content = $request->content;
        $message = $template->save() ? 'Success!' : 'Failed!';
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
        $template = Template::findOrFail($id);
        $message = "Deleting template #$id" . ($template->delete() ? ' Succeed!' : ' Failed!');
        return redirect()->to('/params/template')->withInput($request->all())->with('message', $message);
    }

    public function enable($id)
    {
        $template = Template::findOrFail($id);
        $template->enable();
        $template->save();
        return redirect()->back()->with('message', 'Success!');
    }

    public function disable($id)
    {
        $template = Template::findOrFail($id);
        $template->disable();
        $template->save();
        return redirect()->back()->with('message', 'Success!');
    }
}