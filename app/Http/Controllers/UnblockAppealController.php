<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnblockAppeal;
use Illuminate\Support\Facades\Auth;

class UnblockAppealController extends Controller
{
    public function show(Request $request)
    {
        return view('pages.admin.admin',['show'=>'unblock_appeals']);
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'description'=>'required|string|max:2000',
        ]);

        $unblock_appeal = UnblockAppeal::where('user_id',Auth::id())->where('is_resolved',false)->get();
        $user = Auth::user();

        if(!$unblock_appeal->isEmpty()) {
            return redirect()->route('blocked')
                ->withError('There is already a request');
        }

        UnblockAppeal::create([
            'description'=> $credentials['description'],
            'is_resolved'=> false,
            'user_id'=> Auth::id()
        ]);


        $user->update([
            'status'=>'pending'
        ]);

        return redirect()->route('blocked')
            ->withSuccess('You have successfully created an Unblock Appeal!');
    }

    public function destroy(Request $request,UnblockAppeal $unblock_appeal)
    {
        try {
            $unblock_appeal->proposer()->get()->first()->update([
                'status'=>'blocked'
            ]);

            $unblock_appeal->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    public function accept(Request $request,UnblockAppeal $unblock_appeal)
    {
        try {
            $unblock_appeal->update([
                'is_resolved'=> true,
            ]);

            $unblock_appeal->proposer()->get()->first()->update([
                'status'=>'active'
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}
