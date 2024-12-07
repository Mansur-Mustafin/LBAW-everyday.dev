<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

use Illuminate\Support\Facades\Auth;



class TagController extends Controller
{
   public function getTags()
   {
    return Tag::all();
   } 

   public function store(Request $request, Tag $tag) 
   {
      $this->authorize('store', $tag); 
      try {
         Auth::user()->tags()->attach($request->tag);

         return response()->json(['message' => "Successfully followed {$request->tag}"]);
      } catch (AuthorizationException $e) {
         return response()->json(['message' => "Cannot follow this {$request->tag}"], 403);
      }
   }

   public function delete(Request $request,Tag $tag) 
   {
      $this->authorize('delete', $tag); 
      try {
         Auth::user()->tags()->detach($request->tag);

         return response()->json(['message' => "Successfully unfollowed {$request->tag}"]);
      } catch (AuthorizationException $e) {
         return response()->json(['message' => "Cannot unfollow this {$request->tag}"], 403);
      } 
   }

   public function getFollowingTags() {
      $user = Auth::user();
      $tags = $user->tags()->paginate(10);

      return response()->json([
         'tags' => $tags,
         'next_page' => $tags->currentPage() + 1,
         'last_page' => $tags->lastPage()
      ]);
   }
}
