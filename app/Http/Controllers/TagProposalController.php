<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\TagProposal;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
class TagProposalController extends Controller
{
    public function showCreationForm(Request $request)
    {
        return view('pages.create-tag-proposal');
    }

    public function show(Request $request)
    {
        return view('pages.admin.admin',['show'=>'tag_proposals']);
    }

    public function store(Request $request)
    {
        // TODO: Create Policy
        // $this->authorize('store',$tag_proposal');

        $credentials = $request->validate([
            'name'=>'required|string|max:250',
            'description'=>'required|string|max:1000',
        ]);

        $already_tag = !Tag::where('name',$credentials['name'])->get()->isEmpty();
        $already_tag_proposal = !TagProposal::where('name',$credentials['name'])->get()->isEmpty();

        if($already_tag)
        {
            return redirect()->back()->withErrors('Tag already existed');
        }

        if($already_tag_proposal)
        {
            return redirect()->back()->withErrors('Tag already proposed');
        }
        
        TagProposal::create([
            'name'       => $credentials['name'],
            'description'=> $credentials['description'],
            'is_resolved'=> false,
            'proposer_id'=> Auth::id()
        ]);

        $user = Auth::user();
        return redirect()->route('user.posts',['user'=>$user])
            ->withSuccess('You have successfully created Tag Proposal!');
    }

    public function destroy(Request $request,TagProposal $tag_proposal)
    {
        try {
            $tag_proposal->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    public function acceptTagProposal(Request $request,TagProposal $tag_proposal)
    {
        try {
            $tag_proposal->update([
                'is_resolved'=> true,
            ]);

            Tag::create([
                'name'=>$tag_proposal->name
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    public function accept(Request $request,TagProposal $tag_proposal)
    {
        try {
            $tag_proposal->update([
                'is_resolved'=> true,
            ]);

            Tag::create([
                'name'=>$tag_proposal->name
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}
