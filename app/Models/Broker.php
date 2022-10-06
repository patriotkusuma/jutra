<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','broker_code','buy_fee','sell_fee','user_id'
    ];

}
