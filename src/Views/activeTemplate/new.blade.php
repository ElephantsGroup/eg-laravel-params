@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3 style="float: left">Create new active template</h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/active-template') }}">List</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('params/active-template') }}" method="POST">
                @csrf
                <select name="template" class="form-control">
                    @foreach ($templates as $template)
                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>
        </div>
    </div>
@endsection