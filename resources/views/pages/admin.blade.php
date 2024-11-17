@extends('layouts.app')
@section('content')
    <div class="container mx-auto">
      <div class="flex flex-col border rounded divide-y divide-dashed">
          <div class="grid grid-cols-7 p-3">
            <div>Username</div>
            <div>Public Name</div>
            <div>Email</div>
            <div>Rank</div>
            <div>Status</div>
            <div>Reputation</div>
            <div>Admin</div>
          </div>
          @foreach ($users as $user)
            <div class="grid grid-cols-7 p-2">
              <div>{{ $user->username }}</div>
              <div>{{ $user->public_name }}</div>
              <div>{{ $user->email }}</div>
              <div>{{ $user->rank }}</div>
              <div>{{ $user->status }}</div>
              <div>{{ $user->reputation }}</div>
              <div>{{ $user->isAdmin() ? 'true' : 'false' }}</div>
            </div>
          @endforeach
      </div>
    </div>
@endsection