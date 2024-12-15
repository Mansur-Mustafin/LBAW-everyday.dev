<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
   public function show()
   {
      return view('pages.admin.admin', ['show' => 'tags']);
   }

   public function showCreationForm()
   {
      return view('pages.admin.create-tag');
   }

   public function store(Request $request)
   {
      $validated = $request->validate([
         'name' => 'required|string|max:250|unique:tag,name'
      ], [
         'name.unique' => 'This tag name is already in use.',
      ]);

      Tag::create([
         'name' => $validated['name']
      ]);

      return redirect()->route('admin.tags')
         ->withSuccess('You have sucessfully created a tag!');
   }

   public function destroy(Tag $tag)
   {
      try {
         $tag->delete();
         return response()->json([
            "You have successfully delete $tag->name"
         ]);
      } catch (\Exception $e) {
         // TODO: do we handle this in front?
         return response()->json(['success' => false]);
      }
   }
}
