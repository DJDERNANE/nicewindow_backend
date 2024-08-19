<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpentryProfilesOrderCart extends Model
{
    use HasFactory;

    protected $fillable = ['carpentry_id', 'supplier_id', 'profile_id', 'qty', 'unit_price'];

    protected $table = 'carpentry_profiles_order_cart';

    public function supplier()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
