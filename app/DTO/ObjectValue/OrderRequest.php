<?php

namespace App\DTO\ObjectValue;

class OrderRequest
{
    public function __construct(
        public string $clientId,
        public array $products
    ){}
}
