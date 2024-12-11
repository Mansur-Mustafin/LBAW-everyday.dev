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

   public function show(Request $request)
   {
      return view('pages.admin.admin',['show'=> 'tags']);
   }

   public function showCreationForm(Request $request)
   {
      return view('pages.admin.create-tag');
   }

   public function store(Request $request) 
   {
      $credentials = $request->validate([
         'name'=> 'required|string|max:250'
      ]);

      if(!Tag::where('name',$credentials['name'])->get()->isEmpty()) {
         return redirect()->back()->withErrors('Tag already exists');
      }

      Tag::create([
         'name'=> $credentials['name']
      ]);

      return redirect()->route('admin.tags')
      ->withSuccess('You have sucessfully created a tag!');
   }

   public function destroy(Tag $tag)
   {
      $tag->delete();
      return response()->json([
         "You have successfully delete $tag->name"
      ]);
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
