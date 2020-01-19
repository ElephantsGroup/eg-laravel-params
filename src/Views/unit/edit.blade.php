@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3>@lang('params::all.Edit unit') {{ $unit->name }}</h3>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info" href="{{ url('params/unit/' . $unit->id) }}">@lang('params::all.View')</a>
                <a class="btn btn-info" href="{{ url('params/unit') }}">@lang('params::all.List')</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('params/unit/' . $unit->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input name="name" class="form-control" value="{{ $unit->name }}" />
                <textarea name="description" class="form-control">{{ $unit->description }}</textarea>
                <button class="btn btn-primary" type="submit">@lang('params::all.Update')</button>
            </form>
        </div>
    </div>
@endsection