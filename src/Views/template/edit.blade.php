@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3 style="float: left">Edit template #{{ $template->id }}</h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/template/' . $template->id) }}">View</a>
                <a class="btn btn-info float-right" href="{{ url('params/template') }}">List</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('params/template/' . $template->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input name="name" class="form-control" value="{{ $template->name }}" />
                <textarea name="content" class="form-control">{{ $template->content }}</textarea>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>
@endsection