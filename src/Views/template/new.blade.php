@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3>@lang('params::all.Create new template')</h3>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info" href="{{ url('params/template') }}">@lang('params::all.List')</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('params/template') }}" method="POST">
                @csrf
                <input name="name" class="form-control" />
                <textarea name="content" class="form-control params-rtl"></textarea>
                <button class="btn btn-primary" type="submit">@lang('params::all.Create')</button>
            </form>
        </div>
    </div>
@endsection