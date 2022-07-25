<?php

namespace App\Http\Controllers;

use App\Jobs\ProductCreated;
use App\Jobs\ProductDeleted;
use App\Jobs\ProductUpdated;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function store(Request $data)
    {
        $product = Product::create($data->only('title', 'image'));

        ProductCreated::dispatch($product->toArray())->onQueue('main_queue');

        return response($product, Response::HTTP_CREATED);
    }

    public function update($id, Request $data)
    {
        $product = Product::find($id);

        $product->update($data->only('title', 'image'));

        ProductUpdated::dispatch($product->toArray())->onQueue('main_queue');

        return response($product, Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        Product::destroy($id);

        ProductDeleted::dispatch($id)->onQueue('main_queue');

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
