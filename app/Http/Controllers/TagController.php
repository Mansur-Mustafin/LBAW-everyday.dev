<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;


class TagController extends Controller
{
   public function getTags()
   {
    return Tag::all();
   } 

   public function followTag(Request $request) 
   {
       try {
           // TODO: Tag Policy
           // $this->authorize('follow_tag', $user); 
           Auth::user()->tags()->attach($request->tag);

           return response()->json(['message' => "Successfully followed {$request->tag}"]);
       } catch (AuthorizationException $e) {
           return response()->json(['message' => "Cannot follow this {$request->tag}"], 403);
       }
   }

   public function unfollowTag(Request $request) 
   {
       try {
           // TODO: Tag Policy
           // $this->authorize('follow_tag', $user);
           Auth::user()->tags()->detach($request->tag);

           return response()->json(['message' => "Successfully unfollowed {$request->tag}"]);
       } catch (AuthorizationException $e) {
           return response()->json(['message' => "Cannot unfollow this {$request->tag}"], 403);
       } 
   }

   public function getFollowingTags(User $user) {
       $tags = $user->tags()->paginate(10);

       return response()->json([
           'tags' => $tags,
           'next_page' => $tags->currentPage() + 1,
           'last_page' => $tags->lastPage()
       ]);
   }
}
