<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spend extends Model
{
    use HasFactory;
    protected $fillable = ['supplier_id', 'montant', 'note'];
    public function supplier()
    {
        return $this->belongsTo(User::class);
    }
}
