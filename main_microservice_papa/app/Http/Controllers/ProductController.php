<?php

namespace App\Http\Controllers;

use App\Jobs\ProductLiked;
use App\Models\Product;
use App\Models\ProductUser;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function like($id, $userid, Request $request)
    {
        try {
            $productUser = ProductUser::create([
                'user_id' => $userid,
                'product_id' => $id
            ]);

            ProductLiked::dispatch($productUser->toArray())->onQueue('admin_queue');

            return response([
                'message' => 'success'
            ]);
        } catch (\Exception $exception) {
            return response([
                'error' => 'You already liked this product',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
