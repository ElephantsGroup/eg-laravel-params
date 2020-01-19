@extends('layouts.app')

@section('css')
<link href="{{ asset('vendor/params/css/params.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="btn-toolbar mb-4 params-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-1" role="group" aria-label="">
            <a class="btn btn-secondary" role="button" href="{{ url('params/unit') }}">@lang('params::all.Units')</a>
            <a class="btn btn-secondary" role="button" href="{{ url('params/parameter') }}">@lang('params::all.Parameters')</a>
            <a class="btn btn-secondary" role="button" href="{{ url('params/value') }}">@lang('params::all.Values')</a>
            <a class="btn btn-secondary" role="button" href="{{ url('params/template') }}">@lang('params::all.Templates')</a>
        </div>
        <div class="btn-group mr-1" role="group" aria-label="">
            <a class="btn btn-secondary" role="button" href="{{ url('params/active-template') }}">@lang('params::all.Active Templates')</a>
            <a class="btn btn-secondary" role="button" href="{{ url('params/active-parameter') }}">@lang('params::all.Active Parameters')</a>
        </div>
        <div class="btn-group mr-1" role="group" aria-label="">
            <a class="btn btn-secondary" role="button" href="{{ url('params/snapshot') }}">@lang('params::all.Snapshots')</a>
        </div>
    </div>

    @yield('params-content')
</div>
@endsection

@section('js')
<script src="{{ asset('vendor/params/js/params.js') }}" defer></script>
@endsection
