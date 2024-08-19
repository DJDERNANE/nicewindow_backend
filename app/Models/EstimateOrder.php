<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateOrder extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'carpentry_id', 'estimate_id', 'status'];

    protected $table = 'estimate_orders';

    public function carpentry()
    {
        return $this->belongsTo(User::class, 'carpentry_id');
    }

    public function client()
    {
        return $this->belongsTo(CarpentryClient::class);
    }
}
