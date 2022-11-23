<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class QueryViewStatus extends Model
{
    use HasFactory,HasApiTokens;

    protected $table = 'query_view_status';

    protected $fillable = ['query_id','user_id']; 
}
