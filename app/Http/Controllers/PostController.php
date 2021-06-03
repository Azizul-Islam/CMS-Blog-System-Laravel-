<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    public function create()
    {
        $this->authorize('create',Post::class);
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create',Post::class);
        $data = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'sometimes|nullable',
            'body' => 'required'
        ]);

        if(request('post_image')){
            $data['post_image'] = request('post_image')->store('images');
        }
        auth()->user()->posts()->create($data);
        return redirect()->route('post.index')->with('success','Post created successfully!');
    }
    public function show(Post $post)
    {
        return view('blog-post',compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('view',$post);
        return view('admin.posts.edit',compact('post'));
    }
    
    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'required|string|min:8|max:255',
            'post_image' => 'sometimes|nullable|file',
            'body' => 'required'
        ]);
        $post->title = $data['title'];
        $post->body = $data['body'];
        if(request()->has('post_image')){
            $data['post_image'] = request('post_image')->store('images');
            $post->post_image = $data['post_image'];
        }

        $this->authorize('update',$post);

        $post->save();
        return redirect()->route('post.index')->with('info','Post has been updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        Session::flash('warning','Post was deleted');
        return back();
    }



}
