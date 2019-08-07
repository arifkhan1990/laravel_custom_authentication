@extends('layouts.master')
 

@section('content')
 
    <h2>Successfully logged in <h1 class="font-weight-bold"> {{ auth()->user()->name }}</h1> </h2>
 
@endsection