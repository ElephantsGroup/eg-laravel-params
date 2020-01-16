@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif
    <a class="btn btn-primary" href="{{ url('params/template/create') }}">@lang('params::all.New')</a>
    @foreach ($templates as $template)
    <div class="card mb-2 mt-2">
        <div class="card-header">
            <h3 class="float-left"><a href="{{ url('params/template/' . $template->id) }}">#{{ $template->id }} {{ $template->name }}</a></h3>
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
                <a class="btn btn-info float-right" href="{{ url('params/template/' . $template->id) }}">View</a>
            </div>
        </div>
        <div class="card-body"><p>Content: {{ $template->content }}</p></div>
    </div>
    @endforeach
</div>
@endsection