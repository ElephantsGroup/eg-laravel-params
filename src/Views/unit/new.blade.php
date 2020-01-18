@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3 style="float: left">Create new unit</h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/unit') }}">List</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('params/unit') }}" method="POST">
                @csrf
                <input name="name" class="form-control" />
                <textarea name="description" class="form-control"></textarea>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>
        </div>
    </div>
@endsection