<?php

namespace App\Http\Controllers;

use App\Models\UnblockAppeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnblockAppealController extends Controller
{
    public function show(Request $request)
    {
        return view('pages.admin.admin', ['show' => 'unblock_appeals']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:2000',
        ]);

        $existingAppeal = UnblockAppeal::where('user_id', Auth::id())->where('is_resolved', false)->exists();

        if ($existingAppeal) {
            return redirect()->route('blocked')
                ->withError('There is already an active unblock appeal.');
        }

        UnblockAppeal::create([
            'description' => $validated['description'],
            'is_resolved' => false,
            'user_id' => Auth::id()
        ]);

        Auth::user()->update([
            'status' => 'pending'
        ]);

        return redirect()->route('blocked')
            ->withSuccess('You have successfully created an Unblock Appeal!');
    }

    public function destroy(Request $request, UnblockAppeal $unblock_appeal)
    {
        try {
            $unblock_appeal->proposer()->update([
                'status' => 'blocked'
            ]);
            $unblock_appeal->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    public function accept(Request $request, UnblockAppeal $unblock_appeal)
    {
        try {
            $unblock_appeal->update([
                'is_resolved' => true,
            ]);

            $unblock_appeal->proposer()->update([
                'status' => 'active'
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}
