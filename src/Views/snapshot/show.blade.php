@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3>#{{ $snapshot->id }}</h3>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info" href="{{ url('params/snapshot') }}">@lang('params::all.List')</a>
            </div>
        </div>
        <div class="card-body">
            <span class="tag">{{ $snapshot->user->name }}</span>
            <hr />
            <p>@lang('params::all.Content'): {{ $snapshot->content }}</p>
            <div class="container border border-secondary">
                {!! html_entity_decode(nl2br(e($snapshot->content))) !!}
            </div>
        </div>
    </div>
@endsection