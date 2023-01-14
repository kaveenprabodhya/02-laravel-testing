<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(\App\Models\BlogPost::all());
        $posts = BlogPost::withCount('comments')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        // $validatedData = $request->validate([
        //     // bail means only stop checking or following chain when the first rule which is failed
        //     'title' => 'bail|required|min:5|max:100',
        //     'content' => 'required|max:255',
        // ]);

        $validatedData = $request->validated();

        $post = BlogPost::create($validatedData);
        // $post->title = $request->input('title');
        // $post->title = $validatedData['title'];
        // $post->content = $request->input('content');
        // $post->content = $validatedData['content'];
        // $post->save();

        // return redirect('/posts');
        $request->session()->flash('success', 'Post was created.');
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $post = BlogPost::findOrFail($id);
        $post = BlogPost::with('comments')->findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {

        $post = BlogPost::findOrFail($id);

        $validatedData = $request->validated();
        $post->fill($validatedData);
        $post->save();
        $request->session()->flash('success', 'Post was updated.');
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // dd('destroy');
        // $post = BlogPost::findOrFail($id);
        // $post->delete();
        BlogPost::destroy($id);
        $request->session()->flash('success', 'Post was deleted.');
        return redirect()->route('posts.index');
    }
}