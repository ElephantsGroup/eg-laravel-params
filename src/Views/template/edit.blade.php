@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3 style="float: left">@lang('params::all.Edit template') {{ $template->name }}</h3>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/template/' . $template->id) }}">@lang('params::all.View')</a>
                <a class="btn btn-info float-right" href="{{ url('params/template') }}">@lang('params::all.List')</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('params/template/' . $template->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input name="name" class="form-control" value="{{ $template->name }}" />
                <textarea name="content" class="form-control">{{ $template->content }}</textarea>
                <button class="btn btn-primary" type="submit">@lang('params::all.Update')</button>
            </form>
        </div>
    </div>
@endsection