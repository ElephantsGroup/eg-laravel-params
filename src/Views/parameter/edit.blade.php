@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3>@lang('params::all.Edit parameter') {{ $parameter->name }}</h3>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info" href="{{ url('params/parameter/' . $parameter->id) }}">@lang('params::all.View')</a>
                <a class="btn btn-info" href="{{ url('params/parameter') }}">@lang('params::all.List')</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('params/parameter/' . $parameter->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input name="name" class="form-control" value="{{ $parameter->name }}" />
                <textarea name="description" class="form-control">{{ $parameter->description }}</textarea>
                <select name="unit" class="form-control">
                    @foreach ($units as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit">@lang('params::all.Update')</button>
            </form>
        </div>
    </div>
@endsection