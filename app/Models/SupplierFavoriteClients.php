<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierFavoriteClients extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'supplier_id'];

    //protected $table = 'carpentry_favorite_suppliers';

    public function clients()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
