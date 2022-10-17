<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
class City extends Model
{
    use HasFactory,HasApiTokens,SoftDeletes;

    protected $fillable = [
        'id', 'name', 'city', 'state', 'status','is_top'
    ];

    protected $guarded = ['id'];
}
