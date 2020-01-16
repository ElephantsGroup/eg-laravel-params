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
            <h3 style="float: left">Create new template</h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/template') }}">List</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('params/template') }}" method="POST">
                @csrf
                <input name="name" class="form-control" />
                <textarea name="content" class="form-control"></textarea>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection