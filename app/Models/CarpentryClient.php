<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpentryClient extends Model
{
    use HasFactory;

    protected $fillable = ['carpentry_id', 'name', 'phone_number', 'notes'];

    protected $table = 'carpentry_clients';

    public function estimate_order()
    {
        return $this->hasOne(EstimateOrder::class);
    }
    public function shapes()
    {
        return $this->hasOne(shape::class);
    }
    public function orders()
    {
        return $this->hasMany(CarpentryClientOrder::class);
    }
}
