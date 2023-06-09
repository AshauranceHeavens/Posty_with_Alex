<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {

        return view('posts.index', [
            'posts' => Post::latest()->with(['user', 'likes'])->paginate(20)
        ]);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'body' => 'required',
        ]);

        auth()->user()->posts()->create($formFields);

        return back();
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return back();
    }
}
