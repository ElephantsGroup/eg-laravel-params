@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3>#{{ $activeParameter->id }}</h3>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info" href="{{ url('params/active-parameter') }}">@lang('params::all.List')</a>
            </div>
        </div>
        <div class="card-body">
            <span class="tag">{{ $activeParameter->user->name }}</span>
            <hr />
            <p>@lang('params::all.Placeholder'): {{ $activeParameter->placeholder  }}</p>
            <p>@lang('params::all.Parameter'): <a href="{{ url('params/parameter/' . $activeParameter->parameter->id) }}">{{ $activeParameter->parameter->name }}</a></p>
            <p>@lang('params::all.Template'): <a href="{{ url('params/template/' . $activeParameter->template->id) }}">{{ $activeParameter->template->name }}</a></p>
        </div>
    </div>
@endsection