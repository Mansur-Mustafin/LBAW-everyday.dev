@extends('layouts.app')
@section('content')
    <div class="container mx-auto">
      <div class="flex flex-col gap-4">
          @foreach ($users as $user)
            <div class="grid grid-cols-7 border p-1">
              <div>{{ $user->username }}</div>
              <div>{{ $user->public_name }}</div>
              <div>{{ $user->email }}</div>
              <div>{{ $user->rank }}</div>
              <div>{{ $user->status }}</div>
              <div>{{ $user->reputation }}</div>
              <div>{{ $user->is_admin }}</div>
            </div>
          @endforeach
      </div>
    </div>
@endsection