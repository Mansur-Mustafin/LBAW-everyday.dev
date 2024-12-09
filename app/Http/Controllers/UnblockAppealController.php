<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnblockAppealController extends Controller
{
    //
    public function showCreationForm(Request $request)
    {
        return view('pages.create-unblock-appeal');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name'=>'required|string|max:250',
            'description'=>'required|string|max:1000',
        ]);

        UnblockAppeal::create([
            'name'       => $credentials['name'],
            'description'=> $credentials['description'],
            'is_resolved'=> false,
            'proposer_id'=> Auth::id()
        ]);

        $user = Auth::user();
        return redirect()->route('user.posts',['user'=>$user])
            ->withSuccess('You have successfully created Tag Proposal!');
    }
}
