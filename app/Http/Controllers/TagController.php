<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $user = Auth::user();
         $tags = $user->tags;
         return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $tag = new Tag();
         $tag->title = request('title');
         $tag->user_id = Auth::id();
         $tag->save();
 
         $user = Auth::user();
 
         $tags = $user->tags;
         return response()->json($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
         $tag->title = request('title');
         $tag->user_id = Auth::id();
         $tag->save();
 
         $user = Auth::user();
 
         $tags = $user->tags;
         return response()->json($tags);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tag $tag)
    {
         $tag->delete();
 
         $user = Auth::user();
 
         $tags = $user->tags;
         return response()->json($tags);
    }
}
