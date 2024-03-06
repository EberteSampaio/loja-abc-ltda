<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'product_id', 'amount'];
    protected $hidden = ['created_at', 'updated_at'];
}
