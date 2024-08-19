<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpentryFavoriteSupplier extends Model
{
    use HasFactory;

    protected $fillable = ['carpentry_id', 'supplier_id'];

    protected $table = 'carpentry_favorite_suppliers';

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }
}
