@extends('layouts.app')

@section('content')

@include('parts/menu/_entry_crud_nav')

@include('parts/msg/_error')

<div class="row">        

    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">

        {!! Form::model($param, array('url' => 'entry/'.$param['id'],'enctype' => 'multipart/form-data','class'=>'form')) !!}

            {{ Form::hidden('user_id',Auth::user()->id) }}

            <div class="form-group">
                <label for="place">Place: </label>
                {{ Form::text('place',$param->place,array('placeholder'=>'Place','class'=>'form-control','id'=>'place')) }}
            </div>

            <div class="form-group">
                <label for="comments">Comments: </label>
                {{ Form::textarea('comments',$param->comments,array('placeholder'=>'Comments','class'=>'form-control','id'=>'comments','rows'=>10)) }}
            </div>

            <div class="form-group">
                <label for="image">Image: </label>
                {!! Form::file('image',array('class'=>'img-thumbnail form-control-file','id'=>'image')) !!}
            </div>

            {{ Form::hidden('_method','PUT') }}

            {!! Form::submit('update', array('class'=>'btn btn-default')) !!}
            
        {!! Form::close() !!} 

    </div>
        
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                
        <img src="{{ $param->img_url }}" class="img-responsive medium" alt="{{ $param->place }}">

        <table class="table">
            <thead>
                <tr>
                    <th>Place: </th>
                    <th>{{ $param->place }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>By: </strong></td>
                    <td>{{ $param->user->name }}</td>
                </tr>
                <tr>
                    <td><strong>Modified: </strong></td>
                    <td>{{ $param->time }}</td>
                </tr>
            </tbody>
        </table>     

        <div>
            <p><strong>Comments: </strong></p>
            <p>{{ $param->comments }}</p>
        </div>   

    </div>

</div>

@endsection