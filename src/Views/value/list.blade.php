@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif
    <a class="btn btn-primary" href="{{ url('params/value/create') }}">@lang('params::all.New')</a>
    @foreach ($values as $value)
    <div class="card mb-2 mt-2">
        <div class="card-header">
            <h3 class="float-left"><a href="{{ url('params/value/' . $value->id) }}">#{{ $value->id }}</a></h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/value/' . $value->id) }}">View</a>
            </div>
        </div>
        <div class="card-body"><p>value: {{ $value->value }}</p></div>
    </div>
    @endforeach
</div>
@endsection