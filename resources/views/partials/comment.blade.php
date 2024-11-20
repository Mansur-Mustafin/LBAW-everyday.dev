@php
    $level = $level ?? 0;
@endphp

<div class="py-4" style="margin-left: {{ $level * 20 }}px;">
    <div class="text-sm text-gray-400">
        {{ $comment->user->username ?? 'Unknown' }} • {{ $comment->created_at->diffForHumans() }}
    </div>
    <div class="mt-2">
        {{ $comment->content }}
    </div>
    <div class="mt-2 text-sm">
        <a href="#" class="text-blue-500">Reply</a>
    </div>
    
    @foreach ($comment->replies as $reply)
        @include('partials.comment', ['comment' => $reply, 'level' => $level + 1])
    @endforeach
</div>
