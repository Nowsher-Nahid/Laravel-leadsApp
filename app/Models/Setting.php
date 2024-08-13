<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'max_sold',
        'budget_price_1',
        'budget_price_2',
        'budget_price_3',
        'budget_price_4',
    ];
}
