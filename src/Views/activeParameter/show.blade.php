@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3 style="float: left">#{{ $activeParameter->id }}</h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/active-parameter') }}">List</a>
            </div>
        </div>
        <div class="card-body">
            <p>Parameter: {{ $activeParameter->parameter->name }}</p>
            <p>Template: {{ $activeParameter->template->name }}</p>
        </div>
    </div>
@endsection