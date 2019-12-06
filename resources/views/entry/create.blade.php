@extends('layouts.app')

@section('content')

@include('parts/menu/_entry_crud_nav')

@include('parts/msg/_error')

<div class="row" >
    {!! Form::open(array('url' => 'entry','enctype' => 'multipart/form-data','class'=>'form')) !!}

        {{ Form::hidden('user_id',Auth::user()->id) }}

        <div class="form-group">
            <label for="place">Place: </label>
            {{ Form::text('place',null,array('placeholder'=>'Place','class'=>'form-control','id'=>'place')) }}
        </div>

        <div class="form-group">
            <label for="comments">Comments: </label>
            {{ Form::textarea('comments',null,array('placeholder'=>'Comments','class'=>'form-control','id'=>'comments','rows'=>5)) }}
        </div>

        <div class="form-group">
            <label for="image">Image: </label>
            {!! Form::file('image',array('class'=>'img-thumbnail form-control-file','id'=>'image')) !!}
        </div>

        {{ Form::token() }}
        
        {!! Form::submit('Add a new entry', array('class'=>'btn btn-default')) !!}

    {!! Form::close() !!}
</div>

@endsection