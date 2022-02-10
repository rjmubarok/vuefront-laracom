<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    // protected $_fillable = [
    //     'username', 
    //     'email',
    //     'name',
    // 
    //     'store_name',
    //     'address_two',
    //     'country',
    //     'city',
    //     'state',
    //     'zipecode',
    //     'store_phone',
    //     'password',
    // ];
    protected $guarded = [];
}
