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
            <h3 style="float: left">Edit unit #{{ $unit->id }}</h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/unit/' . $unit->id) }}">View</a>
                <a class="btn btn-info float-right" href="{{ url('params/unit') }}">List</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('params/unit/' . $unit->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input name="name" class="form-control" value="{{ $unit->name }}" />
                <textarea name="description" class="form-control">{{ $unit->description }}</textarea>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection