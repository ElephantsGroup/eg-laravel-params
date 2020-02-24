@extends('params::layouts.params')

@section('params-content')
    <div class="btn-toolbar mb-1" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group form-btn-group" role="group" aria-label="">
            <a class="btn btn-primary" href="{{ url('params/active-template/create') }}">@lang('params::all.New')</a>
        </div>
    </div>
    @foreach ($activeTemplates as $activeTemplate)
    <div class="card mb-2 mt-2">
        <div class="card-header">
            <h3><a href="{{ url('params/active-template/' . $activeTemplate->id) }}">#{{ $activeTemplate->id }}</a></h3>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info" href="{{ url('params/active-template/' . $activeTemplate->id) }}">@lang('params::all.View')</a>
            </div>
        </div>
        <div class="card-body">
            <p>@lang('params::all.Template'): <a href="{{ url('params/template/' . $activeTemplate->template->id) }}">{{ $activeTemplate->template->name }}</a></p>
        </div>
    </div>
    @endforeach
    {{ $activeTemplates->links() }}
@endsection