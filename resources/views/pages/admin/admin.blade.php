@extends('layouts.body.default')

@section('content')

@include('partials.success-popup')

@if ($type == 'users')
  @include('pages.admin.users')
@elseif ($type == 'tags')
  @include('pages.admin.tags')
@else
  @include('pages.admin.tag-proposals')
@endif


@endsection