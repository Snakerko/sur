@extends('layouts.app')

@section('content')
  @if($user->admin == 1)
    @include('www.admin')
  @else
    @include('www.home')
  @endif
@endsection