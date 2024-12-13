<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
   public function show(Request $request)
   {
      return view('pages.admin.admin', ['show' => 'tags']);
   }

   public function showCreationForm(Request $request)
   {
      return view('pages.admin.create-tag');
   }

   public function store(Request $request)
   {
      $credentials = $request->validate([
         'name' => 'required|string|max:250'
      ]);

      if (!Tag::where('name', $credentials['name'])->get()->isEmpty()) {
         return redirect()->back()->withErrors('Tag already exists');
      }

      Tag::create([
         'name' => $credentials['name']
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
}
