<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        $list = Post::published()->paginate(10);
        return view('post.index', ['postList' => $list]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->first();

        if($post !== null) {
            $post->load('attachment');
            return view('post.show', ['post' => $post]);
        } else {
            abort(404);
        }
    }
}
