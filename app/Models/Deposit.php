<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    function broker(){
        return $this->belongsTo(Broker::class,'broker_id','id');
    }
}
