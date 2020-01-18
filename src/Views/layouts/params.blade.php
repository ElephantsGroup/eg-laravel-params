@extends('layouts.app')

@section('content')
<div class="container">
    <div class="btn-toolbar mb-4" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-1 float-left" role="group" aria-label="">
            <a class="btn btn-secondary" role="button" href="{{ url('params/unit') }}">Units</a>
            <a class="btn btn-secondary" role="button" href="{{ url('params/parameter') }}">Parameters</a>
            <a class="btn btn-secondary" role="button" href="{{ url('params/value') }}">Values</a>
            <a class="btn btn-secondary" role="button" href="{{ url('params/template') }}">Templates</a>
        </div>
        <div class="btn-group mr-1 float-left" role="group" aria-label="">
        <a class="btn btn-secondary" role="button" href="{{ url('params/active-template') }}">Active Template</a>
        <a class="btn btn-secondary" role="button" href="{{ url('params/active-parameter') }}">Active Parameters</a>
        </div>
    </div>

    @yield('params-content')
</div>
@endsection
