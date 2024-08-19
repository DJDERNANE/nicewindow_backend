<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlassCarpentry extends Model
{
    use HasFactory;
    protected $fillable = ['Carpentry_Id','price', 'name'];

    public function carpentry()
    {
        return $this->belongsTo(User::class, 'Carpentry_Id');
    }
}
