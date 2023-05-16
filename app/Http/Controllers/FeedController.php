<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class FeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $posts = Feed::where('user_id', $user->id)->latest()->paginate(12);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required'
        ]);

        $request->user()->feeds()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('feed.index', auth()->user()->username);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Feed $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feed $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        $image_path = public_path('uploads/' . $post->image);

        if (File::exists($image_path)) {
            unlink($image_path);
        }

        return redirect()->route('feed.index', auth()->user()->username);
    }
}
