<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Post[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => ["required"],
                'content' => ["required"],
                'slug' => ["required"],
                'description' => ["required"],
                'category_id' => ["required"],
            ]
        );

        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages(),
            ];
        }

        $post = Post::create([
            "title" => $request->title,
            "content" => $request->content,
            "slug" => $request->slug,
            "description" => $request->description,
            "category_id" => $request->category_id,
        ]);

        return [
            "status" => true,
            "post" => $post,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                "status" => false,
                "error" => "Post not found"
            ])->setStatusCode(404);
        }
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return array|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id)->update($request->validate());

        if (!$post) {
            return response()->json([
                "status" => false,
                "error" => "Post not found"
            ])->setStatusCode(404);
        }

        return Post::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                "status" => false,
                "error" => "Post not found"
            ])->setStatusCode(404);
        }
        $post->delete();

        return [
            "status" => true,
            "message" => "Post deleted",
        ];
    }
}
