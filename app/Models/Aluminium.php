<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluminium extends Model
{
    use HasFactory;
    protected $fillable = ['Carpentry_Id', 'white_price', 'colored_price', 'name'];

    public function carpentry()
    {
        return $this->belongsTo(User::class, 'Carpentry_Id');
    }
}
