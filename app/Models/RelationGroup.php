<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'user_id', 'name', 'status'
    ];

    protected $guarded = ['id'];
}
