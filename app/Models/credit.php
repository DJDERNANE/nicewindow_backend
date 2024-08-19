<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class credit extends Model
{
    use HasFactory;
    protected $fillable = [
        'carpentry_id',
        'supplier_id',
        'montant',
        'note'
    ];
    public function carpentry()
    {
        return $this->belongsTo(User::class, 'carpentry_id');
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }
}
