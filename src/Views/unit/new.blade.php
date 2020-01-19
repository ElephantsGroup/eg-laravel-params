@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3>@lang('params::all.Create new unit')</h3>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info" href="{{ url('params/unit') }}">@lang('params::all.List')</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('params/unit') }}" method="POST">
                @csrf
                <input name="name" class="form-control" />
                <textarea name="description" class="form-control"></textarea>
                <button class="btn btn-primary" type="submit">@lang('params::all.Create')</button>
            </form>
        </div>
    </div>
@endsection