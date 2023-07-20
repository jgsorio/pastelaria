<?php

namespace App\Repositories;

use App\DTO\Orders\OrderRepositoryStoreOrUpdateDTO;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Ramsey\Uuid\Uuid;

class OrderRepository implements OrderRepositoryInterface
{
    public function __construct(protected Order $model, protected Product $productModel){}

    public function all(array $filters): array|null
    {
        try {
            $results = [];
            $orders = $this->model->where(function ($query) use ($filters) {
                foreach ($filters as $key => $filter) {
                    $query->orWhere($key, $filter);
                }
            })
            ->get()
            ->groupBy('id')
            ->toArray();
            
            foreach ($orders as $key => $order) {
                $products = [];
                foreach ($order as $k => $value) {
                    $products[$k] = [
                        'id' => $value['product_id']
                    ];
                }

                $results[] = [
                    'id' => $order[0]['id'],
                    'client_id' => $order[0]['client_id'],
                    'products' => $products
                ];
            }
            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function store(OrderRepositoryStoreOrUpdateDTO $data): array
    {
        try {
            $products = [];
            $id = Uuid::uuid4();
            foreach ($data->request->products as $key => $product) {
                $products[$key] = $this->productModel->where('id', $product['id'])->first();
                $this->model->create([
                    'id' => $id->toString(),
                    'product_id' => $product['id'],
                    'client_id' => $data->request->clientId
                ]);
            }

            return [
                'id' => $id->toString(),
                'client_id' => $data->request->clientId,
                'products' => $products
            ];

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function show(string $id): array|null
    {
        try {
            return $this->all(['id' => $id]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(string $id, OrderRepositoryStoreOrUpdateDTO $data): array
    {
        try {
            $orders = $this->model->where('id', $id)->get();
            foreach ($orders as $order) {
                $order->delete();
            }

            foreach ($data->request->products as $key => $product) {
                $products[$key] = $this->productModel->where('id', $product['id'])->first();
                $this->model->create([
                    'id' => $id,
                    'product_id' => $product['id'],
                    'client_id' => $data->request->clientId
                ]);
            }

            return [
                'id' => $id,
                'client_id' => $data->request->clientId,
                'products' => $products
            ];

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(string $id): void
    {
        try {
            $orders = $this->model->where('id', $id)->get();
            if ($orders) {
                foreach ($orders as $order) {
                    $order->delete();
                }
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
