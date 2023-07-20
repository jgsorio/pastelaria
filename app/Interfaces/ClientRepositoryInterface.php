<?php

namespace App\Interfaces;

use App\DTO\Clients\ClientRepositoryStoreOrUpdateDTO;
use App\Models\Client;

interface ClientRepositoryInterface
{
    public function all(array $filters): array;
    public function store(ClientRepositoryStoreOrUpdateDTO $data): Client;
    public function show(string $id): Client|null;
    public function update(string $id, ClientRepositoryStoreOrUpdateDTO $data): Client|null;
    public function delete(string $id): void;
}
