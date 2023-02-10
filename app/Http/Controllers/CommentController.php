<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Exception;

class CommentController extends Controller
{
    public $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepositoryInterface)
    {
        $this->commentRepository = $commentRepositoryInterface;
    }

    public function createComment(Request $request, $idProduct)
    {
        $params = $request->only(['content', 'model']);

        try {
            $this->commentRepository->createComment($params, $idProduct);

            return response()->json([
                'statusCode' => 200,
                'message' => 'Tạo mới thành công',
                'data' => []
            ]);
        } catch (Exception $e) {

            return response()->json([
                'statusCode' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
    }

    public function deleteComment(Request $request, $id)
    {
        try {
            $this->commentRepository->deleteComment($id);

            return response()->json([
                'statusCode' => 200,
                'message' => 'Xóa thành công',
                'data' => []
            ]);
        } catch (Exception $e) {

            return response()->json([
                'statusCode' => 200,
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }

    }

    public function like(Request $request, $id)
    {
        $params = $request->only(['like']);

        try {
            $this->commentRepository->like($params, $id);

            return response()->json([
                'statusCode' => 200,
                'message' => 'Bày tỏ cảm xúc thành công',
                'data' => []
            ]);
        } catch (Exception $e) {

            return response()->json([
                'statusCode' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
    }

    public function getCommentInProduct(Request $request, $id)
    {
        try {
            $comment = $this->commentRepository->getCommentInProduct($id);

            return response()->json([
                'statusCode' => 200,
                'message' => 'Lấy thông tin thành công',
                'data' => $comment
            ]);
        } catch (Exception $e) {

            return response()->json([
                'statusCode' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
    }
}
