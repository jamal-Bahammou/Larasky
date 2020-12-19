<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller {

    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    // 🎣 GET ALL THE POST FUNCTION
    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);
    }

    // 🎣 RENDER THE create PAGE
    public function create() {
        return view('posts.create');
    }

    // 🎯 CREATE NEW POST FUNCTION
    public function store(Request $request) {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable'
        ]);

        // 📷 Handle file upload
        if( $request->hasFile('cover_image') ) {
            // Get filename with the extension
            $filenameWithExtension = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // The file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'null.jpg';
        }

        // 📸 CREATE POST
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'New post created successfly');
    }

    // 🎣 GET A SINGLE POST BY $id
    public function show($id) {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    // 🎣 RENDER THE edit PAGE WITH THE $post DATA 
    public function edit($id) {
        $post = Post::find($id);

        // Check for correct user
        if( Auth()->user()->id !== $post->user_id ) {
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        return view('posts.edit')->with('post', $post);
    }

    // 🎯 UPDATE POST FUNCTION
    public function update(Request $request, $id) {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        // 📷 Handle file upload
        if( $request->hasFile('cover_image') ) {
            // Get filename with the extension
            $filenameWithExtension = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // The file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
            
        // 📸 UPDATE POST
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        // Check the image to delete it
        if( $post->cover_image != 'null.jpg' ) {
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        if( $request->hasFile('cover_image') ) {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post updated successfly');

    }

    // 🎯 DELETE POST BY $id
    public function destroy($id) {
        
        $post = Post::find($id);

        // Check for correct user
        if( Auth()->user()->id !== $post->user_id ) {
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        // Check the image to delete it
        if( $post->cover_image != 'null.jpg' ) {
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post deleted successfly');

    }
}
