@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3>#{{ $value->id }}</h3>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info" href="{{ url('params/value') }}">@lang('params::all.List')</a>
            </div>
        </div>
        <div class="card-body">
            <p>@lang('params::all.Value'): {{ $value->value }}</p>
            <p>@lang('params::all.Parameter'): <a href="{{ url('params/parameter/' . $value->parameter->id) }}">{{ $value->parameter->name }}</a></p>
        </div>
    </div>
@endsection