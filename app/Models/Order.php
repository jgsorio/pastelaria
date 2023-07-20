<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = ['id', 'client_id', 'product_id'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }
}
