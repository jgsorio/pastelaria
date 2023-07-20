<?php

namespace App\Interfaces;

use App\DTO\Products\ProductRepositoryStoreOrUpdateDTO;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function all(array $filters): array;
    public function store(ProductRepositoryStoreOrUpdateDTO $data): Product;
    public function show(string $product): Product|null;
    public function update(string $product, ProductRepositoryStoreOrUpdateDTO $data): Product|null;
    public function delete(string $product): void;
}
