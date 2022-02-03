<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vandor extends Model
{
    use HasFactory;
    // protected $_fillable = [
    //     'username', 
    //     'email',
    //     'first_name',
    //     'last_name',
    //     'store_name',
    //     'address_tow',
    //     'country',
    //     'city',
    //     'state',
    //     'zipecode',
    //     'store_phone',
    //     'password',
    // ];
    protected $guarded = [];
}
