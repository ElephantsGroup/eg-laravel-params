@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 style="float: left">#{{ $activeTemplate->id }}</h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/active-template') }}">List</a>
            </div>
        </div>
        <div class="card-body"><p></p></div>
    </div>
</div>
@endsection