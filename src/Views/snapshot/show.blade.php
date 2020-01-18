@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3 style="float: left">#{{ $snapshot->id }}</h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/snapshot') }}">List</a>
            </div>
        </div>
        <div class="card-body"><p>Content: {{ $snapshot->content }}</p></div>
    </div>
@endsection