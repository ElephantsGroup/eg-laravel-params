@extends('params::layouts.params')

@section('params-content')
    <a class="btn btn-primary" href="{{ url('params/unit/create') }}">@lang('params::all.New')</a>
    @foreach ($units as $unit)
    <div class="card mb-2 mt-2">
        <div class="card-header">
            <h3 class="float-left"><a href="{{ url('params/unit/' . $unit->id) }}">#{{ $unit->id }} {{ $unit->name }}</a></h3>
            <form class="btn-group mr-1 float-right" role="group" aria-label="" action="{{ url('params/unit/' . $unit->id) }}" method="POST">
                <a class="btn btn-primary" role="button" href="{{ url('params/unit/' . $unit->id . '/edit') }}">@lang('params::all.Edit')</a>
                @csrf
                @method('DELETE')
                <button class="btn btn-primary" role="button" type="submit">@lang('params::all.Delete')</button>
            </form>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/unit/' . $unit->id) }}">@lang('params::all.View')</a>
            </div>
        </div>
        <div class="card-body">
            <p>@lang('params::all.Description'): {{ $unit->description }}</p>
            <p>
                @lang('params::all.Parameters'):
                <ul>
                    @foreach ($unit->parameters as $parameter)
                    <li><a href="{{ url('params/parameter/' .  $parameter->id) }}">{{ $parameter->name }}</a></li>
                    @endforeach
                    <li><a href="{{ url('params/parameter/create?unit_id=' . $unit->id) }}">+</a></li>
                <ul>
            </p>
        </div>
    </div>
    @endforeach
@endsection