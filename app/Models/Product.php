<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function matches($query_str)
    {
        return self::when($query_str, function ($query, $query_str) {
            return $query->where('name', 'LIKE', "%{$query_str}%");
        });
    }

}
