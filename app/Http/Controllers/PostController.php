<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use function Pest\Laravel\post;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\File;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        /* return view("posts.index")->with("posts".$posts); */
        return view("posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile("image")) {
            $imageName = $request->file("image")->getClientOriginalName() . "-" . time() . $request->file("image")->getClientOriginalExtension();
            $request->file("image")->move(public_path("/images/posts"), $imageName);
        }
        Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "image" => $imageName
        ]);
        return redirect()->route("posts.index");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $posts  = Post::findOrFail($id);
        return view('posts.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $posts = Post::findOrFail($id);
        return view('posts.edit', compact('posts'));
    }
    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            if ($image) {
                $oldImage = $post->image; 
                if ($oldImage && File::exists(public_path('images/posts/' . $oldImage))) 
                { File::delete(public_path('images/posts/' . $oldImage));
                }
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/posts'), $filename);
                $post->image = $filename;
            }    
        }
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();
        return redirect()->route('posts.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post_id = Post::findOrFail($id);
        $oldImage = $post_id->image;

        
        if ($post_id->delete()) {
            if ($oldImage && File::exists(public_path('images/posts/' . $oldImage))) 
            { File::delete(public_path('images/posts/' . $oldImage));
            }
            return redirect()->route("posts.index");
        }
    }
}