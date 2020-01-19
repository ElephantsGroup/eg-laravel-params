@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3 style="float: left">Create new active parameter</h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/active-parameter') }}">List</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('params/active-parameter') }}" method="POST">
                @csrf
                <input name="placeholder" class="form-control" />
                <select name="parameter" class="form-control">
                    @foreach ($parameters as $parameter)
                    <option value="{{ $parameter->id }}"@if (request()->get('parameter_id') == $parameter->id) ' selected="selected"' @endif>{{ $parameter->name }}</option>
                    @endforeach
                </select>
                <select name="template" class="form-control">
                    <option value="0">Select template ...</option>
                    @foreach ($templates as $template)
                    <option value="{{ $template->id }}"@if (request()->get('template_id') == $template->id) ' selected="selected"' @endif>{{ $template->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>
        </div>
    </div>
@endsection