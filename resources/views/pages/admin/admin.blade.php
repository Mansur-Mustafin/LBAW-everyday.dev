@extends('layouts.app')
@section('content')

@include('partials.success-popup')

@if ($type == 'users')
  @include('pages.admin.users')
@else
  @include('pages.admin.tags')
@endif


@endsection