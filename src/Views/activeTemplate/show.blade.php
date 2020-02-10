@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3>#{{ $activeTemplate->id }}</h3>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info" href="{{ url('params/active-template') }}">@lang('params::all.List')</a>
            </div>
        </div>
        <div class="card-body">
            <span class="tag">{{ $activeTemplate->user->name }}</span>
            <hr />
            <p>@lang('params::all.Template'): <a href="{{ url('params/template/' . $activeTemplate->template->id) }}">{{ $activeTemplate->template->name }}</a></p>
            <div class="container border border-secondary">
                {!! html_entity_decode(nl2br(e($activeTemplate->template->content))) !!}
            </div>
        </div>
    </div>
@endsection