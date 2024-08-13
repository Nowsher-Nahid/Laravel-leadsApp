<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_type',
        'services',
        'budget',
        'price',
        'description',
        'deadline',
        'name',
        'phone',
        'email',
        'company',
        'website_url',
        'status',
    ];
}
