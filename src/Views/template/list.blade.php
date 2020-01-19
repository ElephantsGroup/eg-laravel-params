@extends('params::layouts.params')

@section('params-content')
    <div class="btn-toolbar mb-1" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group float-left" role="group" aria-label="">
            <a class="btn btn-primary float-left" href="{{ url('params/template/create') }}">@lang('params::all.New')</a>
        </div>
        <div class="btn-group ml-auto float-right" role="group" aria-label="">
            <a class="btn btn-default float-right{{ request()->get('show') === 'all' ? ' disabled' : '' }}" href="{{ url('params/template?show=all') }}">@lang('params::all.all')</a>
            <a class="btn btn-default float-right{{ (!request()->has('show') || request()->get('show') === 'enabled') ? ' disabled' : '' }}" href="{{ url('params/template?show=enabled') }}">@lang('params::all.enabled')</a>
            <a class="btn btn-default float-right{{ request()->get('show') === 'disabled' ? ' disabled' : '' }}" href="{{ url('params/template?show=disabled') }}">@lang('params::all.disabled')</a>
        </div>
    </div>
    @foreach ($templates as $template)
    <div class="card mb-2 mt-2{{ ($activeTemplate && $activeTemplate->template_id === $template->id) ? ' selected-card' : ''}}">
        <div class="card-header">
            <h3 class="float-left"><a href="{{ url('params/template/' . $template->id) }}">#{{ $template->id }} {{ $template->name }}</a></h3>
            @if (!$activeTemplate || $activeTemplate->template_id != $template->id)
            <form class="btn-group mr-1 float-right" role="group" aria-label="" action="{{ url('params/active-template') }}" method="POST">
                @csrf
                <input type="hidden" name="template" value="{{ $template->id }}" />
                <button class="btn btn-primary" role="button" type="submit">@lang('params::all.Activate')</button>
            </form>
            @endif
            <form class="btn-group mr-1 float-right" role="group" aria-label="" action="{{ url('params/template/' . $template->id) }}" method="POST">
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
            <div class="btn-group mr-2 float-right" role="group">
                <a class="btn btn-info float-right" href="{{ url('params/template/' . $template->id) }}">@lang('params::all.View')</a>
            </div>
        </div>
        <div class="card-body"><p>@lang('params::all.Content'): {{ $template->content }}</p></div>
    </div>
    @endforeach
@endsection