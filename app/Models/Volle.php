<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volle extends Model
{
    use HasFactory;
    protected $fillable = ['Carpentry_Id', 'name', 'price'];

    public function carpentry()
    {
        return $this->belongsTo(User::class, 'Carpentry_Id');
    }
}
