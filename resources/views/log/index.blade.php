@extends('layouts.app')

@section('content')

<h1>Log</h1>

<div class="row" >
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Time</th>
                <th>Actor ID</th>
                <th>Actor Name</th>
                <th>Model</th>
                <th>Table</th>
                <th>Method</th>
                <th>Record key name</th>
                <th>Record ID</th>
                <th>Previous State</th>
                <th>Modified State</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        	@foreach($logs as $log)
				<tr>
					<td>{!! $log['id'] !!}</td>
	                <td>{!! $log['time'] !!}</td>
	                <td>{!! $log['user_id'] !!}</td>
	                <td>{!! $log['user_name'] !!}</td>
	                <td>{!! $log['model'] !!}</td>
	                <td>{!! $log['table_name'] !!}</td>
	                <td>{!! $log['method'] !!}</td>
	                <td>{!! $log['record_key_name'] !!}</td>
	                <td>{!! $log['record_id'] !!}</td>
	                <td>
	                	<table class="table">
							@if (!empty($log['initial_state']))
								@foreach ($log['initial_state'] as $initLabel => $initValue)
									@if (!in_array($initLabel, ['img_url', 'time']))
										<tr>
											<th>{!! $initLabel !!}</th>
											<td>{!! $initValue !!}</td>
										</tr>
									@endif
									@if ($initLabel === 'img_url')
										<tr>
											<th>{!! $initLabel !!}</th>
											<td>
												<img src="{!! $initValue !!}" alt="none available" style="width: 100%; object-fit: scale-down; margin: auto; display: block;" />
											</td>
										</tr>
									@endif
								@endforeach
							@endif
						</table>
	                </td>
	                <td>
	                	<table class="table">
							@if (!empty($log['modified_state']))
								@foreach ($log['modified_state'] as $modLabel => $modValue)
									@if (!in_array($modLabel, ['img_url', 'time']))
										<tr>
											<th>{!! $modLabel !!}</th>
											<td>{!! $modValue !!}</td>
										</tr>
									@endif
									@if ($modLabel === 'img_url')
										<tr>
											<th>{!! $modLabel !!}</th>
											<td>
												<img src="{!! $modValue !!}" alt="none available" style="width: 100%; object-fit: scale-down; margin: auto; display: block;" />
											</td>
										</tr>
									@endif
								@endforeach
							@endif
						</table>
	                </td>
	                <td>
    	    			{!! Form::open(array('url' => 'log/restore' ,'enctype' => 'multipart/form-data', 'class'=>'form-inline')) !!}
                            {{ Form::hidden('log_id', $log['id']) }}
                            {!! Form::submit('Restore', array('class'=>'btn btn-default')) !!}
                        {!! Form::close() !!}	
	                </td>
				</tr>
        	@endforeach
        </tbody>
    </table>
</div>

@endsection