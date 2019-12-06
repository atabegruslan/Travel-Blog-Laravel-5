@extends('layouts.app')

@section('content')

<h1>Contact Travel Blog</h1>

<hr />

@include('parts/msg/_success')

@include('parts/msg/_error')

<div class="row">
	{!! Form::open(array('url' => 'email', 'class' => 'form')) !!}

	<div class="form-group">
	    {!! Form::label('Your Name') !!}
	    {!! Form::text('name', Auth::user()->name,  
	        array('required', 
	              'class'=>'form-control', 
	              'placeholder'=>'Your name')) !!}
	</div>

	<div class="form-group">
	    {!! Form::label('Your Email Address') !!}
	    {!! Form::text('email', Auth::user()->email, 
	        array('required', 
	              'class'=>'form-control', 
	              'placeholder'=>'Your Email Address')) !!}
	</div>

	<div class="form-group">
	    {!! Form::label('Your Email Subject') !!}
	    {!! Form::text('subject', null, 
	        array('required', 
	              'class'=>'form-control', 
	              'placeholder'=>'Your Email Subject')) !!}
	</div>

	<div class="form-group">
	    {!! Form::label('Your Message') !!}
	    {!! Form::textarea('body', null, 
	        array('required', 
	              'class'=>'form-control', 
	              'placeholder'=>'Your message')) !!}
	</div>

	<div class="form-group">
	    {!! Form::submit('Contact Us!', 
	      array('class'=>'btn btn-primary')) !!}
	</div>
	{!! Form::close() !!}
</div>

@endsection