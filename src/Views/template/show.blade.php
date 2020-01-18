@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3 style="float: left">#{{ $template->id }} {{ $template->name }}</h3>
            <form class="btn-group mr-1 float-right" role="group" aria-label="" action="{{ url('params/template/' . $template->id) }}" method="POST">
                <a class="btn btn-primary" role="button" href="{{ url('params/template/' . $template->id . '/edit') }}">Edit</a>
                @csrf
                @method('DELETE')
                <button class="btn btn-primary" role="button" type="submit">Delete</button>
                @if ($template->enabled())
                <a class="btn btn-primary" role="button" href="{{ url('params/template/' . $template->id . '/disable') }}">Disable</a>
                @else
                <a class="btn btn-primary" role="button" href="{{ url('params/template/' . $template->id . '/enable') }}">Enable</a>
                @endif
            </form>
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/template') }}">List</a>
            </div>
        </div>
        <div class="card-body"><p>Content: {{ $template->content }}</p></div>
    </div>
@endsection