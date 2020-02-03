@extends('layouts.app')

@section('css')
<link href="{{ asset('vendor/params/css/Chart.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/params/css/params.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="btn-toolbar mb-4 params-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-1" role="group" aria-label="">
            <a class="btn btn-secondary pr-0 pl-1" role="button" href="#"></a>
            <a class="btn btn-secondary level3-menu collapse" role="button" href="{{ url('params/unit') }}">@lang('params::all.Units')</a>
            <a class="btn btn-secondary level1-menu collapse show" role="button" href="{{ url('params/parameter') }}">@lang('params::all.Parameters')</a>
            <a class="btn btn-secondary level3-menu collapse" role="button" href="{{ url('params/value') }}">@lang('params::all.Values')</a>
            <a class="btn btn-secondary level2-menu collapse" role="button" href="{{ url('params/template') }}">@lang('params::all.Templates')</a>
            <a class="btn btn-secondary pl-0 pr-1" role="button" href="#"></a>
        </div>
        <div class="btn-group mr-1" role="group" aria-label="">
            <a class="btn btn-secondary level2-menu collapse pr-0 pl-1" role="button" href="#"></a>
            <a class="btn btn-secondary level3-menu collapse" role="button" href="{{ url('params/active-template') }}">@lang('params::all.Active Templates')</a>
            <a class="btn btn-secondary level2-menu collapse" role="button" href="{{ url('params/active-parameter') }}">@lang('params::all.Active Parameters')</a>
            <a class="btn btn-secondary level2-menu collapse pl-0 pr-1" role="button" href="#"></a>
        </div>
        <div class="btn-group mr-1" role="group" aria-label="">
            <a class="btn btn-secondary level1-menu collapse show" role="button" href="{{ url('params/snapshot') }}">@lang('params::all.Snapshots')</a>
        </div>
        <div class="btn-group mr-1" role="group" aria-label="">
            <a class="btn btn-danger level1-spacer pl-1 pr-0" role="button" href="#"></a>
            <button class="btn btn-danger level1-button" type="button" data-target=".level2-menu" data-toggle="collapse" aria-expanded="false" onClick="ToggleExpendMenu(this)">+</button>
            <button class="btn btn-danger level2-button d-none" type="button" data-target=".level3-menu" data-toggle="collapse" aria-expanded="false" onClick="ToggleMoreExpendMenu(this)">++</button>
            <a class="btn btn-danger level1-spacer pl-0 pr-1" role="button" href="#"></a>
        </div>
    </div>

    @yield('params-content')
</div>
@endsection

@section('js')
<script src="{{ asset('vendor/params/js/Chart.min.js') }}" defer></script>
<script src="{{ asset('vendor/params/js/params.js') }}" defer></script>
@endsection
