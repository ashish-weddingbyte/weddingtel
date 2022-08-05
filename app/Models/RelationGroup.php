<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Sanctum\HasApiTokens;

class RelationGroup extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'type', 'user_id', 'name', 'status'
    ];

    protected $guarded = ['id'];
}
