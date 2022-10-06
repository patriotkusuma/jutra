<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emiten extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'code',
        'listing_date',
        'shares',
        'listing_board',
    ];
}
