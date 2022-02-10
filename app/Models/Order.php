<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
     protected $_fillable = [
        'customer_id', 
        'shiping_id',
        'supplier_id',
        'payment_id',
        'supplier_date',
    ];
}
