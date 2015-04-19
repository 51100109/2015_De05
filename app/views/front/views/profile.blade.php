@extends('front.layouts.mainlayout')

@section('title')
Softsharing - Profile
@endsection

@section('content')
	<h2>Welcome "{{ Auth::user()->username }}" to the protected page!</h2>
  <p>Your user ID is: {{ Auth::user()->id }}</p>
  {{ Auth::user()->birthday }}
@endsection