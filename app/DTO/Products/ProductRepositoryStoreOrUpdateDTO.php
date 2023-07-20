<?php

namespace App\DTO\Products;

use Illuminate\Http\UploadedFile;

class ProductRepositoryStoreOrUpdateDTO
{
    public function __construct(
        public string $name,
        public int $price,
        public UploadedFile|null $photo = null
    ){}
}
