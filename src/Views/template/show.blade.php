@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3>#{{ $template->id }} {{ $template->name }}</h3>
            <form class="btn-group mr-2" role="group" aria-label="" action="{{ url('params/template/' . $template->id) }}" method="POST">
                <a class="btn btn-primary" role="button" href="{{ url('params/template/' . $template->id . '/edit') }}">@lang('params::all.Edit')</a>
                @csrf
                @method('DELETE')
                <button class="btn btn-primary" role="button" type="submit">@lang('params::all.Delete')</button>
                @if ($template->enabled())
                <a class="btn btn-primary" role="button" href="{{ url('params/template/' . $template->id . '/disable') }}">@lang('params::all.Disable')</a>
                @else
                <a class="btn btn-primary" role="button" href="{{ url('params/template/' . $template->id . '/enable') }}">@lang('params::all.Enable')</a>
                @endif
            </form>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info" href="{{ url('params/template') }}">@lang('params::all.List')</a>
            </div>
        </div>
        <div class="card-body">
            <span class="tag">{{ $template->user->name }}</span>
            <hr />
            <p>@lang('params::all.Content'): {{ $template->content }}</p>
            <div class="container border border-secondary">
                {!! html_entity_decode(nl2br(e($template->content))) !!}
            </div>
            <p>
                @lang('params::all.Activations'):
                <ul>
                    <li><a href="{{ url('params/active-parameter/create?template_id=' . $template->id) }}">+</a></li>
                    @foreach ($activations as $placeholder => $parameter)
                    <li>@lang('params::all.Placeholder') {{ $placeholder }} @lang('params::all.for parameter') <a href="{{ url('params/parameter/' . $parameter->id) }}">{{ $parameter->name }}</a></li>
                    @endforeach
                </ul>
            </p>
        </div>
    </div>
@endsection