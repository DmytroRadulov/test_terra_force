<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $posts = Post::where('user_id', $users->id)->paginate(6);
        return view('post.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show', compact('post'));
    }

    public function create()
    {
        $post = new Post();
        $isCreate = true;
        $users = Auth::user();
        return view('post.form', compact('post', 'users', 'isCreate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'unique:posts,title',
                'min:5',
            ],
            'body' => ['required',
                'min:4',
                'unique:posts,body',],
            'user_id' => ['exists:users,id'],
        ]);

        Post::create($request->all());
        return redirect()->route('post')->with('success', 'Post created successfully');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $isCreate = false;
        $users = Auth::user();
        return view('post.form', compact('post', 'users', 'isCreate'));
    }

    public function update(Request $request)
    {
        $post = Post::find($request->input('id'));
        $request->validate([
            'title' => [
                'required',
                'min:5',
                Rule::unique('posts', 'title')->ignore($post->id),
            ],
            'body' => ['required',
                'min:4',
                Rule::unique('posts', 'body')->ignore($post->id),],
            'user_id' => ['exists:users,id'],
        ]);
        $post->update($request->all());
        return redirect()->route('post')->with('success', 'Post created successfully');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('post')->with('success', 'Post delete successfully');
    }

}
