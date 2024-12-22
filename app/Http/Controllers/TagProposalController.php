<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\TagProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagProposalController extends Controller
{
    public function showCreationForm()
    {
        return view('pages.user.create-tag-proposal');
    }

    public function show()
    {
        return view('pages.admin.admin', ['show' => 'tag_proposals']);
    }

    public function store(Request $request)
    {
        // TODO: Create Policy
        // $this->authorize('store',$tag_proposal');

        $validated = $request->validate([
            'name' => 'required|string|max:250',
            'description' => 'required|string|max:1000',
        ]);

        if (Tag::where('name', $validated['name'])->exists()) {
            return redirect()->back()->withErrors(['name' => 'Tag already existed.']);
        }

        if (TagProposal::where('name', $validated['name'])->exists()) {
            return redirect()->back()->withErrors(['name' => 'Tag already proposed.']);
        }

        TagProposal::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'is_resolved' => false,
            'proposer_id' => Auth::id()
        ]);

        return redirect()->route('user.posts', ['user' => Auth::user()])
            ->withSuccess('You have successfully created Tag Proposal!');
    }

    public function destroy(TagProposal $tagProposal)
    {
        try {
            $tagProposal->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tag proposal deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the tag proposal.'
            ]);
        }
    }

    public function accept(TagProposal $tagProposal)
    {
        try {
            $tagProposal->update([
                'is_resolved' => true,
            ]);

            Tag::create([
                'name' => $tagProposal->name
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tag proposal accepted and tag created.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while accepting the tag proposal.'
            ]);
        }
    }
}
