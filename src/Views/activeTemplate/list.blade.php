@extends('params::layouts.params')

@section('params-content')
    <a class="btn btn-primary" href="{{ url('params/active-template/create') }}">@lang('params::all.New')</a>
    @foreach ($activeTemplates as $activeTemplate)
    <div class="card mb-2 mt-2">
        <div class="card-header">
            <h3 class="float-left"><a href="{{ url('params/active-template/' . $activeTemplate->id) }}">#{{ $activeTemplate->id }}</a></h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/active-template/' . $activeTemplate->id) }}">@lang('params::all.View')</a>
            </div>
        </div>
        <div class="card-body">
            <p>@lang('params::all.Template'): <a href="{{ url('params/template/' . $activeTemplate->template->id) }}">{{ $activeTemplate->template->name }}</a></p>
        </div>
    </div>
    @endforeach
@endsection