<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leads extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'mobile',
        'budget',
        'details',
        'category_id',
        'event_date',
        'city',
        'view_count',
        'status',
        'approved_status',
        'apply_tags'
    ];
}
