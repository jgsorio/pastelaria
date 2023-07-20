<?php

namespace App\Http\Controllers;

use App\DTO\Products\ProductRepositoryStoreOrUpdateDTO;
use App\Http\Requests\ProductStoreOrUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{
    public function __construct(private ProductRepositoryInterface $repository){}

    public function index(Request $request)
    {
        $products = $this->repository->all(json_decode($request->filters) ?? []);
        return ProductResource::collection($products);
    }

    public function store(ProductStoreOrUpdateRequest $request)
    {
        try {
            $product = $this->repository->store(
                new ProductRepositoryStoreOrUpdateDTO(
                    name: $request->name,
                    price: $request->price,
                    photo: $request->photo ?? null
                )
            );

            return new ProductResource($product);
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $product = $this->repository->show($id);
            return new ProductResource($product);
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function update(string $id, Request $request)
    {
        try {
            $product = $this->repository->update(
                $id,
                new ProductRepositoryStoreOrUpdateDTO(
                    name: $request->name,
                    price: $request->price,
                    photo: $request->photo ?? null
                )
            );

            return new ProductResource($product);
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->repository->delete($id);
            return response()->json([], 204);
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
