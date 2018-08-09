@extends('layouts.app')

@section('content')
    <h1>Test</h1>
    <p>Name : {{ Auth::user()->name }}</p>
    <p>Last name : {{ Auth::user()->last_name }}</p>
    <p>Email : {{ Auth::user()->email }}</p>
    <p>Date of birth : {{ Auth::user()->date_of_birth }}</p>
    {{ Auth::user()->email }}
    {{ Auth::user()->date_of_birth }}
    {{ Auth::user()->county }}
    {{ Auth::user()->gender }}
    {{ Auth::user()->affiliation }}
    {{ Auth::user()->lines_of_research }}
@endsection