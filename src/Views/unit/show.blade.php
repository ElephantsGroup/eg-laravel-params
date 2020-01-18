@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3 style="float: left">#{{ $unit->id }} {{ $unit->name }}</h3>
            <form class="btn-group mr-1 float-right" role="group" aria-label="" action="{{ url('params/unit/' . $unit->id) }}" method="POST">
                <a class="btn btn-primary" role="button" href="{{ url('params/unit/' . $unit->id . '/edit') }}">Edit</a>
                @csrf
                @method('DELETE')
                <button class="btn btn-primary" role="button" type="submit">Delete</button>
            </form>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/unit') }}">List</a>
            </div>
        </div>
        <div class="card-body">
            <p>{{ __('Description') }}: {{ $unit->description }}</p>
            <p>
                {{ __('Parameters') }}:
                <ul>
                    @foreach ($unit->parameters as $parameter)
                    <li><a href="{{ url('params/parameter/' .  $parameter->id) }}">{{ $parameter->name }}</a></li>
                    @endforeach
                <ul>
            </p>
        </div>
    </div>
@endsection