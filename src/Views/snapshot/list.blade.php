@extends('params::layouts.params')

@section('params-content')
    <div class="btn-toolbar mb-1" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group form-btn-group" role="group" aria-label="">
            <form action="{{ url('params/snapshot') }}" method="POST">
                @csrf
                <button class="btn btn-primary" role="button" type="submit">@lang('params::all.New')</button>
            </form>
        </div>
    </div>
    @foreach ($snapshots as $snapshot)
    <div class="card mb-2 mt-2">
        <div class="card-header">
            <h3><a href="{{ url('params/snapshot/' . $snapshot->id) }}">#{{ $snapshot->id }}</a></h3>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info" href="{{ url('params/snapshot/' . $snapshot->id) }}">@lang('params::all.View')</a>
            </div>
        </div>
        <div class="card-body"><p>@lang('params::all.Content'): {{ $snapshot->content }}</p></div>
    </div>
    @endforeach
@endsection