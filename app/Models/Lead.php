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
        'sold_count',
    ];

    protected $casts = [
        'status_changed_at' => 'datetime',
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
