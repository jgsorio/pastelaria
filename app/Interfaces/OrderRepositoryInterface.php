<?php

namespace App\Interfaces;

use App\DTO\Orders\OrderRepositoryStoreOrUpdateDTO;

interface OrderRepositoryInterface
{
   public function store(OrderRepositoryStoreOrUpdateDTO $data): array;
   public function all(array $filters): array|null;
   public function show(string $id): array|null;
   public function update(string $id, OrderRepositoryStoreOrUpdateDTO $data): array;
   public function delete(string $id): void;
}
