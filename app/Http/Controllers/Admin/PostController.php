<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    protected $validationRules = [
        'title'=>'required|min:5|max:255|unique:posts',
        'post_content' => 'required|min:10',
        'post_image'=>'required|active_url',
    ];

    protected $validationMessages =  [
        'title.required' => 'Inserisci il titolo!',
        'post_content.required' => 'Inserisci la serie!',
        'post_image.required' => 'Inserisci l\'immagine!',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        return view('admin.posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->validationRules, $this->validationMessages);
        $data = $request->all();
        $newPost = new Post();
        $newPost->title = $data['title'];
        $newPost->post_content = $data['post_content'];
        $newPost->post_image = $data['post_image'];
        //dd($newPost);
        $newPost-> save();

        return redirect()->route('admin.posts.show', $newPost->id)->with('created', $data['title']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate($this->validationRules, $this->validationMessages);
        $data = $request->all();
        $post = Post::findOrFail($id);
        $post = new Post();
        $post->title = $data['title'];
        $post->post_contente = $data['post_content'];
        $post->post_image = $data['post_image'];
        //dd($post);
        $post->save();
         return redirect()->route('admin.posts.show', $post->id)->with('edited', $data['title']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('delete', $post->title);

    }
}
