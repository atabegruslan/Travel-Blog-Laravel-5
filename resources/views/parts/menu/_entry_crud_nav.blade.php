<div class='row'>
	<ul class="list-inline">
		@if( strcmp( Route::currentRouteName(), 'entry.edit') === 0 )
			<li>
		    	{{ link_to_route('entry.show', 'Back', [ $param['id'] ], ['class' => 'btn btn-primary'] ) }}
		    </li>
		@endif

		<li>
			{{ link_to_route('entry.index', 'View All', [], ['class' => 'btn btn-primary'] ) }}
		</li>

		@if( strcmp( Route::currentRouteName(), 'entry.show') === 0 )
			<li>
		    	{{ link_to_route('entry.edit', 'Edit', [ $param['id'] ], ['class' => 'btn btn-primary'] ) }}
		    </li>

		    <li>
			    {!! Form::open(array('url' => 'entry/'.$param['id'],'enctype' => 'multipart/form-data','class'=>'form-inline')) !!}
			        {{ Form::hidden('_method','DELETE') }}
			        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
			    {!! Form::close() !!} 
			</li>
		@endif

		@if( strcmp( Route::currentRouteName(), 'entry.index') === 0 )
			<li>
				{{ link_to_route('entry.create', 'Create New', [], ['class' => 'btn btn-primary'] ) }}
			</li>

			<li id='search'>
		        {!! Form::open(array('method'=>'GET','url' => 'search','class'=>'form-inline')) !!}
		            {!! Form::text('search', null, array('required', 'class'=>'form-control')) !!}
		            {!! Form::submit('Search', array('class'=>'btn btn-default')) !!}
		        {!! Form::close() !!}  
			</li>
		@endif

	</ul>
</div>
