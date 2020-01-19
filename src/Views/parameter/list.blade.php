@extends('params::layouts.params')

@section('params-content')
    <div class="btn-toolbar mb-1" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group float-left" role="group" aria-label="">
            <a class="btn btn-primary float-left" href="{{ url('params/parameter/create') }}">@lang('params::all.New')</a>
        </div>
        <div class="btn-group ml-auto float-right" role="group" aria-label="">
            <a class="btn btn-default float-right{{ request()->get('show') === 'all' ? ' disabled' : '' }}" href="{{ url('params/parameter?show=all') }}">@lang('params::all.all')</a>
            <a class="btn btn-default float-right{{ (!request()->has('show') || request()->get('show') === 'enabled') ? ' disabled' : '' }}" href="{{ url('params/parameter?show=enabled') }}">@lang('params::all.enabled')</a>
            <a class="btn btn-default float-right{{ request()->get('show') === 'disabled' ? ' disabled' : '' }}" href="{{ url('params/parameter?show=disabled') }}">@lang('params::all.disabled')</a>
        </div>
    </div>
    @foreach ($parameters as $parameter)
    <div class="card mb-2 mt-2">
        <div class="card-header">
            <h3 class="float-left"><a href="{{ url('params/parameter/' . $parameter->id) }}">#{{ $parameter->id }} {{ $parameter->name }}</a></h3>
            <form class="btn-group mr-1 float-right" role="group" aria-label="" action="{{ url('params/parameter/' . $parameter->id) }}" method="POST">
                <a class="btn btn-primary" role="button" href="{{ url('params/parameter/' . $parameter->id . '/edit') }}">Edit</a>
                @csrf
                @method('DELETE')
                <button class="btn btn-primary" role="button" type="submit">Delete</button>
                @if ($parameter->enabled())
                <a class="btn btn-primary" role="button" href="{{ url('params/parameter/' . $parameter->id . '/disable') }}">Disable</a>
                @else
                <a class="btn btn-primary" role="button" href="{{ url('params/parameter/' . $parameter->id . '/enable') }}">Enable</a>
                @endif
            </form>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/parameter/' . $parameter->id) }}">View</a>
            </div>
        </div>
        <div class="card-body">
            <p>{{ __('Description')}}: {{ $parameter->description }}</p>
            <p>{{ __('Unit') }} : <a href="{{ url('params/unit/' . $parameter->unit->id) }}">{{ $parameter->unit->name }}</a></p>
            <p>
                {{ __('Values') }}:
                <ul>
                    <li><a href="{{ url('params/value/create?parameter_id=' . $parameter->id) }}">{{ __('+') }}</a></li>
                    @foreach ($parameter->latestValues as $value)
                    <li><a href="{{ url('params/value/' . $value->id) }}">{{ $value->value }}</a></li>
                    @endforeach
                </ul>
            </p>
        </div>
    </div>
    @endforeach
@endsection