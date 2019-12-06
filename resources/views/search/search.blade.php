@extends('layouts.app')

@section('content')

@include('parts/menu/_entry_crud_nav')

@include('parts/msg/_search_success')
 
@include('parts/msg/_search_err')

@include('parts/_archive')

@endsection