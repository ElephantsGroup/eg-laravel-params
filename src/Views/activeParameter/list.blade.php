@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif
    <a class="btn btn-primary" href="{{ url('params/active-parameter/create') }}">@lang('params::all.New')</a>
    @foreach ($activeParameters as $activeParameter)
    <div class="card mb-2 mt-2">
        <div class="card-header">
            <h3 class="float-left"><a href="{{ url('params/active-parameter/' . $activeParameter->id) }}">#{{ $activeParameter->id }}</a></h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/active-parameter/' . $activeParameter->id) }}">View</a>
            </div>
        </div>
        <div class="card-body">
            <p>Parameter: {{ $activeParameter->parameter->name }}</p>
            <p>Template: {{ $activeParameter->template->name }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection