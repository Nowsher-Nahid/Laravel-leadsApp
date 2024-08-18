<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'job_type',
        'budget'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
