@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3 style="float: left">#{{ $activeTemplate->id }}</h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/active-template') }}">List</a>
            </div>
        </div>
        <div class="card-body">
            <p>{{ __('Template') }}: <a href="{{ url('params/template/' . $activeTemplate->template->id) }}">{{ $activeTemplate->template->name }}</a></p>
        </div>
    </div>
@endsection