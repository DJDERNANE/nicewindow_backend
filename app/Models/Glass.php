<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Glass extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en', 'name_fr', 'price'];

    protected $table = 'glass';
}
