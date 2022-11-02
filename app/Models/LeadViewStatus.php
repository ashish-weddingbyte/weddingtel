<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class LeadViewStatus extends Model
{
    use HasFactory,HasApiTokens;

    protected $table = 'lead_view_status';

    protected $fillable = ['lead_id','user_id','created_at']; 
}
