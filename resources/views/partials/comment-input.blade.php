<form id="subCommentForm-{{$comment->id}}" class="hidden items-center -mt-2">
   <input type="text"
      class="outline-none p-4 w-full border border-solid border-gray-700 bg-input rounded-xl hover:border-white hover:border-opacity-70"
      placeholder="Share your thoughts" id="{{"subCommentInput-$comment->id"}}" />
   <button class="-ml-20 px-5 py-2 rounded-xl bg-purple" type="submit">Post</button>
</form>