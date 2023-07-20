<?php

namespace App\DTO\Orders;

use App\DTO\ObjectValue\OrderRequest;

class OrderRepositoryStoreOrUpdateDTO
{
    public function __construct(
        public OrderRequest $request
    ){}
}
