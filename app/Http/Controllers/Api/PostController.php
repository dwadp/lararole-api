<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => Post::create($validated)
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $post = Post::where('id', $id)->first();

        $post->update($validated);

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => null
        ]);
    }

    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();

        $post->destroy();

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => null
        ]);
    }
}
