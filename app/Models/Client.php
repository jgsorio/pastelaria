<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'email', 'phone', 'birthdate', 'address', 'complement', 'neighborhood', 'zipcode'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
