@extends('params::layouts.params')

@section('params-content')
    <div class="card">
        <div class="card-header">
            <h3>#{{ $parameter->id }} {{ $parameter->name }}</h3>
            <form class="btn-group mr-2" role="group" aria-label="" action="{{ url('params/parameter/' . $parameter->id) }}" method="POST">
                <a class="btn btn-primary" role="button" href="{{ url('params/parameter/' . $parameter->id . '/edit') }}">@lang('params::all.Edit')</a>
                @csrf
                @method('DELETE')
                <button class="btn btn-primary" role="button" type="submit">@lang('params::all.Delete')</button>
                @if ($parameter->enabled())
                <a class="btn btn-primary" role="button" href="{{ url('params/parameter/' . $parameter->id . '/disable') }}">@lang('params::all.Disable')</a>
                @else
                <a class="btn btn-primary" role="button" href="{{ url('params/parameter/' . $parameter->id . '/enable') }}">@lang('params::all.Enable')</a>
                @endif
            </form>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info" href="{{ url('params/parameter') }}">@lang('params::all.List')</a>
            </div>
        </div>
        <div class="card-body">
            <p>@lang('params::all.Description'): {{ $parameter->description }}</p>
            <p>@lang('params::all.Unit'): <a href="{{ url('params/unit/' . $parameter->unit->id) }}">{{ $parameter->unit->name }}</a></p>
            <p>
                @lang('params::all.Activations'):
                <ul>
                    <li><a href="{{ url('params/active-parameter/create?parameter_id=' . $parameter->id) }}">+</a></li>
                    @foreach ($activations as $placeholder => $template)
                    @if ($template)
                    <li>@lang('params::all.Placeholder') {{ $placeholder }} @lang('params::all.on template') <a href="{{ url('params/template/' . $template->id) }}">{{ $template->name }}</a></li>
                    @else
                    <li>@lang('params::all.Placeholder') {{ $placeholder }} @lang('params::all.on all templates')</li>
                    @endif
                    @endforeach
                </ul>
            </p>
            <p>
                @lang('params::all.Values'):
                <ul>
                    <li><a href="{{ url('params/value/create?parameter_id=' . $parameter->id) }}">+</a></li>
                    @foreach ($parameter->latestValues as $value)
                    <li><a href="{{ url('params/value/' . $value->id) }}">{{ $value->value }}</a></li>
                    @endforeach
                </ul>
            </p>
            <canvas id="canvas"></canvas>
        </div>
    </div>
	<script>
		var config = {
			type: 'line',
			data: {
				labels: [
                    @foreach ($stats as $stat)
                    '{{ $stat['date'] }}',
                    @endforeach
                ],
				datasets: [{
					label: '',
					backgroundColor: "blue",
					borderColor: "blue",
					data: [
                        @foreach ($stats as $stat)
                        {{ $stat['value'] }},
                        @endforeach
                    ],
					fill: false,
				}]
			},
			options: {
				responsive: true,
				tooltips: {
					mode: 'point',
					intersect: true,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Date'
						}
					}],
					yAxes: [{ display: false }]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};
	</script>
@endsection