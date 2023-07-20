<?php

namespace App\Repositories;

use App\DTO\Products\ProductRepositoryStoreOrUpdateDTO;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{

    public function __construct(protected Product $model)
    {}

    public function all(array $filters = []): array
    {
        return $this->model->where(function ($query) use ($filters) {
            foreach ($filters as $filter) {
                foreach ($filter as $key => $value) {
                    $query->where($key, 'like', "%{$value}%");
                }
            }
        })
        ->get()
        ->toArray();
    }

    public function store(ProductRepositoryStoreOrUpdateDTO $data): Product
    {
        try {
            $photoName = $data->photo ? $data->photo->getClientOriginalName() : 'default.png';
            if ($data->photo) {
                Storage::putFileAs('public/products', $data->photo, $photoName);
            }
            
            $data = (array)$data;
            $data['photo'] = $photoName;
            return $this->model->updateOrCreate(
                [
                    'name' => $data['name']
                ],
                $data
            );

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function show(string $id): Product|null
    {
        try {
            return $this->model->find($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(string $id, ProductRepositoryStoreOrUpdateDTO $data): Product|null
    {
        try {
            $product = $this->model->find($id);
            if ($product) {
                $photoName = $product->photo;
                if ($data->photo) {
                    $photoName = $data->photo ? $data->photo->getClientOriginalName() : 'default.png';
                    if ($product->photo !== 'default.png') {
                        Storage::delete("public/products/{$product->photo}");
                    }

                    Storage::putFileAs('public/products', $data->photo, $photoName);
                }

                $data = (array)$data;
                $data['photo'] = $photoName;
                $product->update($data);
                return $product;
            }

            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(string $id): void
    {
        try {
            $product = $this->model->find($id);
            if ($product) {
                if ($product->photo !== 'default.png') {
                    Storage::delete("public/products/{$product->photo}");
                }

                $product->delete();
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
