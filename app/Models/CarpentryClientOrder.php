<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpentryClientOrder extends Model
{
    use HasFactory;
    protected $fillable = ['carpentry_id', 'client_id', 'total_price','promotion', 'payment_status', 'paye', 'credit'];
    
    public function carpentry()
    {
        return $this->belongsTo(User::class, 'carpentry_id');
    }

    public function client()
    {
        return $this->belongsTo(CarpentryClient::class, 'client_id');
    }
}
