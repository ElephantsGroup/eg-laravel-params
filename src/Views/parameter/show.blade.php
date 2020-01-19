@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3 style="float: left">#{{ $parameter->id }} {{ $parameter->name }}</h3>
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
                <a class="btn btn-info float-right" href="{{ url('params/parameter') }}">List</a>
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
            <p>
                {{ __('Activations') }}:
                <ul>
                    <li><a href="{{ url('params/active-parameter/create?parameter_id=' . $parameter->id) }}">{{ __('+') }}</a></li>
                    @foreach ($activations as $placeholder => $template)
                    @if ($template)
                    <li>{{ __('Placeholder') }} {{ $placeholder }} {{ __('on template') }} <a href="{{ url('params/template/' . $template->id) }}">{{ $template->name }}</a></li>
                    @else
                    <li>{{ __('Placeholder') }} {{ $placeholder }} {{ __('on all templates') }}</li>
                    @endif
                    @endforeach
                </ul>
            </p>
        </div>
    </div>
@endsection