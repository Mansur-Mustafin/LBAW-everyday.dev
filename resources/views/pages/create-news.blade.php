@extends('layouts.app')

@section('content')
<section class="flex flex-col border-x border-gray-700 self-center ml-64 mr-96 h-full">
   <form class="px-3 flex flex-col gap-4 mt-4">
      <button class="bg-input rounded-3xl px-6 py-8 w-40 min-h-35" id="personalizedFileInput">Thumbnail</button>
      <input class="hidden" type="file" id="realFileInput">

      <input class="rounded-2xl bg-input outline-none p-3" placeholder="Post title*" required>
      <textarea class="rounded-2xl bg-input outline-none p-3"></textarea>
      <button class="text-input bg-white font-bold rounded-3xl px-6 py-2 self-end" type="submit">Post</button>
   </form>
</section>
@endsection