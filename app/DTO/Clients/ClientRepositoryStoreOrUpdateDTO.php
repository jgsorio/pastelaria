<?php

namespace App\DTO\Clients;

use DateTime;
use Exception;

class ClientRepositoryStoreOrUpdateDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public string $birthdate,
        public string $address,
        public string $neighborhood,
        public string $zipcode,
        public string $complement = ''
    ){}
}
