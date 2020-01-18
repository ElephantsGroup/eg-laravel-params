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
        <div class="card-body"><p>{{ $parameter->description }}</p></div>
    </div>
@endsection