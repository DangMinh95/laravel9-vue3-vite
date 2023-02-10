<?php

namespace App\Http\Controllers;

use App\Repositories\Comment\CommentRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    public $productRepository;
    public $commentRepository;

    public function __construct(
        ProductRepositoryInterface $productRepositoryInterface,
        CommentRepositoryInterface $commentRepositoryInterface
    )
    {
        $this->productRepository = $productRepositoryInterface;
        $this->commentRepository = $commentRepositoryInterface;
    }

    public function getAllProduct()
    {
        try {
            $cacheName = config('common.allproduct');
            if (Redis::get($cacheName)) {
                return response()->json([
                    'statusCode' => 200,
                    'message' => 'Tìm kiếm thành công(cached)',
                    'data' => json_decode(Redis::get($cacheName), true),
                ]);
            }
            $product = $this->productRepository->getAllProduct();
            Redis::set($cacheName, $product);

            return response()->json([
                'statusCode' => 200,
                'message' => 'Tìm kiếm thành công',
                'data' => $product,
            ]);
        } catch (Exception $e) {
            // dd($e->getMessage());
            return response()->json([
                'statusCode' => 500,
                'message' => 'Không thành công',
                'data' => [],
            ]);
        }
    }

    public function search(Request $request)
    {
        try {
            $product = $this->productRepository->search($request->all());

            return response()->json([
                'statusCode' => 200,
                'message' => 'Tìm kiếm thành công',
                'data' => $product,
            ]);
        } catch (Exception $e) {
            // dd($e->getMessage());
            return response()->json([
                'statusCode' => 500,
                'message' => 'Không thành công',
                'data' => [],
            ]);
        }

    }

    public function getProduct(Request $request, $id)
    {
        try {
            $product = $this->productRepository->getProduct($id);

            return response()->json([
                'statusCode' => 200,
                'message' => 'Thành công',
                'data' => $product,
            ]);
        } catch (Exception $e) {

            return response()->json([
                'statusCode' => 500,
                'message' => 'Không thành công',
                'data' => $product,
            ]);
        }
    }

    public function createProduct(ProductRequest $request)
    {
        $params = $request->only(['pname', 'price', 'category_id', 'manufactor']);

        try {
            $this->productRepository->createProduct($params);

            return response()->json([
                'statusCode' => 200,
                'message' => 'Tạo mới thành công',
                'data' => []
            ]);
        } catch (Exception $e) {

            return response()->json([
                'statusCode' => 500,
                'message' => 'Không thành công',
                'data' => []
            ]);
        }
    }

    public function updateProduct(ProductRequest $request, $id)
    {
        $params = $request->only(['pname', 'price', 'category_id', 'manufactor']);
        try {
            $this->productRepository->updateProduct($params, $id);

            return response()->json([
                'statusCode' => 200,
                'message' => 'Cập nhật thành công',
                'data' => []
            ]);
        } catch (Exception $e) {

            return response()->json([
                'statusCode' => 500,
                'message' => 'Không thành công',
                'data' => []
            ]);
        }

    }

    public function deleteProduct(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->productRepository->deleteProduct($id);
            $this->commentRepository->deleteCommentOfProduct($id);
            DB::commit();
            return response()->json([
                'statusCode' => 200,
                'message' => 'Xóa thành công',
                'data' => []
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'statusCode' => 500,
                'message' => 'Không thành công',
                'data' => []
            ]);
        }

    }
}
