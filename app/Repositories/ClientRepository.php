<?php

namespace App\Repositories;

use App\DTO\Clients\ClientRepositoryFiltersDTO;
use App\DTO\Clients\ClientRepositoryStoreOrUpdateDTO;
use App\Interfaces\ClientRepositoryInterface;
use App\Models\Client;
use Exception;

class ClientRepository implements ClientRepositoryInterface
{
    protected $model;

    public function __construct(Client $model)
    {
        $this->model = $model;
    }

    public function all(array $filters): array
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

    public function store(ClientRepositoryStoreOrUpdateDTO $data): Client
    {
        try {
            
            return $this->model->create((array)$data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function show(string $id): Client|null
    {
        try {
            return $this->model->find($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(string $id, ClientRepositoryStoreOrUpdateDTO $data): Client|null
    {
        try {
            $client = $this->model->find($id);
            if ($client) {
                $client->update((array)$data);
                return $client;
            }

            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(string $id): void
    {
        try {
            $client = $this->model->find($id);
            $client->orders()->delete();
            $client->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
