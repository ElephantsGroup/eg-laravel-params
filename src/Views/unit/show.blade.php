@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3>#{{ $unit->id }} {{ $unit->name }}</h3>
            <form class="btn-group mr-2" role="group" aria-label="" action="{{ url('params/unit/' . $unit->id) }}" method="POST">
                <a class="btn btn-primary" role="button" href="{{ url('params/unit/' . $unit->id . '/edit') }}">@lang('params::all.Edit')</a>
                @csrf
                @method('DELETE')
                <button class="btn btn-primary" role="button" type="submit">@lang('params::all.Delete')</button>
            </form>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info" href="{{ url('params/unit') }}">@lang('params::all.List')</a>
            </div>
        </div>
        <div class="card-body">
            <span class="tag">{{ $unit->user->name }}</span>
            <hr />
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
@endsection