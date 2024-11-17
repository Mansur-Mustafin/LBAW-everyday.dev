<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsPost;
use App\Models\Tag;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request) {
        $search_query = $request->search;
        $newsPosts = NewsPost::join('user','user.id','=',"news_post.id")
                ->whereRaw('(tsvectors @@ plainto_tsquery(\'english\',?) OR title=?)',[$search_query,$search_query])
                ->orderByRaw('ts_rank(tsvectors,plainto_tsquery(\'english\',?)) DESC',[$search_query])
                ->get()
                ->makeHidden('password');

        $tag_query= $search_query == '' ? '' :"%".ucfirst($search_query)."%"; 
        $user_query= $search_query == '' ? '' : $search_query."%"; 
        $tags = Tag::where('name','like',$tag_query)->get();
        $users_from_username = User::where('username','like', $user_query)->get();
        $users_from_public_name = User::where('public_name','like',$user_query)->get();

        $users = $users_from_username->merge($users_from_public_name);

        return response()->json([
            "news_posts"=>$newsPosts,
            "tags"=>$tags,
            "users"=>$users,
        ],200);
    }
}