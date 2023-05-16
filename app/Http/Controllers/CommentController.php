<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feed;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user, Feed $post)
    {
        $this->validate($request, [
            'comment' => 'required|max:255'
        ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'feed_id' => $post->id,
            'comment' => $request->comment
        ]);

        return back()->with('message', 'You commented this post');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
