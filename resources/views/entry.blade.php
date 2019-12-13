@extends('layouts.app')

@section('content')

<h1 class="row" >Welcome {{ Auth::user()->name }}</h1>

<p>This is a compact table view with CRUD capibilities. This template is not being called by any controllers nor can be displayed. The code here is just for reference.</p>

<div class='row'>
    <div id='search'>
        {!! Form::open(array('method'=>'GET','url' => 'search','class'=>'form-inline')) !!}
            {!! Form::text('search', null, array('required', 'class'=>'form-control')) !!}
            {!! Form::submit('Search', array('class'=>'btn btn-default')) !!}
        {!! Form::close() !!}  
    </div> 
</div>

<div id='all' class='row'>
    <a href="{{ url('entry') }}">See All</a>
</div>

<div class="row" >
    <table class="table">
        <thead>
            <tr>
                <th>Time</th>
                <th>User</th>
                <th>Place</th>
                <th>Comments</th>
                <th>Picture</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <tbody>
            <tr>
                {!! Form::open(array('url' => 'entry','enctype' => 'multipart/form-data','class'=>'form-inline')) !!}
                    <td>
                        <?php date_default_timezone_set( date_default_timezone_get() ); ?>
                        {{ date('Y-m-d H:i:s', time() ) }}
                    </td>
                    <td>
                        {{ Auth::user()->name }}
                        {{ Form::hidden('user',Auth::user()->name) }}
                    </td>               
                    <td>
                        {{ Form::text('place',null,array('placeholder'=>'Place','class'=>'form-control')) }}
                    </td>
                    <td>
                        {{ Form::textarea ('comments',null,array('placeholder'=>'Comments','class'=>'form-control','rows'=>1)) }}
                    </td>
                    <td>
                        {!! Form::file('image',array('class'=>'img-thumbnail')) !!}
                    </td>
                    <td>
                        {{ Form::token() }}
                        {!! Form::submit('Add a new entry', array('class'=>'btn btn-default')) !!}
                    </td>
                    <td></td>
                {!! Form::close() !!}
            </tr>

    	    @foreach($param as $k => $v)
    	    	<tr>
                    <td>{!! date('Y-m-d h:i:s', strtotime($v['time']) ) !!}</td>
    	    		<td>{!! $v['user'] !!}</td>
    	    		<td>
    	    			<a href="entry/{!! $v['id'] !!}">
    	    				{!! $v['place'] !!}
    	    			</a>
    	    		</td>
    	    		<td>{!! $v['comments'] !!}</td>
    	    		<td>
                        <img src="{!! $v['img_url'] !!}">
    	    		</td>
    	    		<td>
    	    			{!! Form::open(array('url' => 'entry/'.$v['id'],'enctype' => 'multipart/form-data','class'=>'form-inline')) !!}
    	    				{{ Form::textarea ('comments',$v['comments'],array('class'=>'form-control','rows'=>1)) }}
    	    				{{ Form::hidden('user',Auth::user()->name) }}
                            {{ Form::hidden('_method','PUT') }}
                            {!! Form::submit('update', array('class'=>'btn btn-default')) !!}
                        {!! Form::close() !!}	    			
    	    		</td>
    	    		<td>
    	    			{!! Form::open(array('url' => 'entry/'.$v['id'],'enctype' => 'multipart/form-data','class'=>'form-inline')) !!}
                            {{ Form::hidden('_method','DELETE') }}
                            {!! Form::submit('delete', array('class'=>'btn btn-default')) !!}
                        {!! Form::close() !!}	    			
    	    		</td>
    	    	</tr>
    	    @endforeach
        </tbody>
    </table> 
</div>

<div class="row" >
    <div id="paginate">
        @if(Route::currentRouteName() != 'entry.show')
            {{ $param->links() }}
        @endif
    </div>
</div>

@endsection