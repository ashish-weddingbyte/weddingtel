<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Sanctum\HasApiTokens;

class Checklist extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'user_id', 'type', 'task', 'added_date', 'status'
    ];

    protected $guarded = ['id'];

}
