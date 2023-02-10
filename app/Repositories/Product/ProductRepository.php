<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @return mixed
     */
    public function search($params)
    {
        $limit = $params['limit'] ?? 5;

        $query = Product::select('pname', 'price', 'manufactor')
            ->selectRaw('category_name as category')
            ->leftJoin('categories', 'products.category_id', 'categories.id');
        if (isset($params['pname'])) {
            $query->where('pname', $params['pname']);
        }
        if (isset($params['price'])) {
            $query->where('price', $params['price']);
        }
        if (isset($params['category_id'])) {
            $query->where('category_id', $params['category_id']);
        }
        if (isset($params['manufactor'])) {
            $query->where('manufactor', $params['manufactor']);
        }
        return $query->get()->chunk($limit);
    }

    /**
     * @return mixed
     */
    public function getProduct($id)
    {
        return Product::select('pname', 'price', 'category_name as category', 'manufactor')
            ->leftJoin('categories', 'products.category_id', 'categories.id')->find($id);
    }

    /**
     * @return mixed
     */
    public function createProduct($params)
    {
        Product::create([
            'pname' => $params['pname'],
            'price' => $params['price'],
            'category_id' => $params['category_id'],
            'manufactor' => $params['manufactor']
        ]);
    }

    /**
     * @return mixed
     */
    public function updateProduct($params, $id)
    {
        Product::where('id', $id)->update([
            'pname' => $params['pname'],
            'price' => $params['price'],
            'category_id' => $params['category_id'],
            'manufactor' => $params['manufactor'],
        ]);
    }

    /**
     * @return
     */
    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();
    }

    /**
     * @return mixed
     */
    public function getAllProduct()
    {
        return Product::select('pname', 'price', 'category_name as category', 'manufactor')
            ->leftJoin('categories', 'products.category_id', 'categories.id')->get();
    }
}
