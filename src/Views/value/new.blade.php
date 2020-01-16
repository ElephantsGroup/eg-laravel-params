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
            <h3 style="float: left">Create new value</h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/value') }}">List</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('params/value') }}" method="POST">
                @csrf
                <input name="value" class="form-control" />
                <select name="parameter" class="form-control">
                    @foreach ($parameters as $parameter)
                    <option value="{{ $parameter->id }}">{{ $parameter->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection