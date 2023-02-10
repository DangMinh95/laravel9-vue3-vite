<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * @param Request $request
     * @param Post $post
     */
    public function updateController(Request $request, Post $post)
    {
        $params = $request->only(['title']);
        try {
            $post->update([
                'title' => $params['title']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thành công',
            'data' => []
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllPost()
    {
        try {
            $id = Auth::id();
            $post = Post::where('user_id', $id)->get();
            $post->makeHidden(['user_id']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Lấy thông tin thành công',
            'data' => $post
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPost(Request $request)
    {
        $params = $request->only(['title']);
        try {
            Post::create([
                'title' => $params['title'],
                'user_id' => Auth::id()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Thêm mới thành công',
            'data' => []
        ]);
    }

    public function deletePost(Request $request, Post $post)
    {
        try {
            $post->delete();
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Xóa thành công',
            'data' => []
        ]);
    }
}
