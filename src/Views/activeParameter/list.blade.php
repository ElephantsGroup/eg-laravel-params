@extends('params::layouts.params')

@section('params-content')
    <a class="btn btn-primary" href="{{ url('params/active-parameter/create') }}">@lang('params::all.New')</a>
    @foreach ($activeParameters as $activeParameter)
    <div class="card mb-2 mt-2">
        <div class="card-header">
            <h3 class="float-left"><a href="{{ url('params/active-parameter/' . $activeParameter->id) }}">#{{ $activeParameter->id }}</a></h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/active-parameter/' . $activeParameter->id) }}">@lang('params::all.View')</a>
            </div>
        </div>
        <div class="card-body">
            <p>@lang('params::all.Placeholder'): {{ $activeParameter->placeholder  }}</p>
            <p>@lang('params::all.Parameter'): <a href="{{ url('params/parameter/' . $activeParameter->parameter->id) }}">{{ $activeParameter->parameter->name }}</a></p>
            <p>@lang('params::all.Template'): <a href="{{ url('params/template/' . $activeParameter->template->id) }}">{{ $activeParameter->template->name }}</a></p>
        </div>
    </div>
    @endforeach
@endsection