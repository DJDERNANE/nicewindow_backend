<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shape extends Model
{
    use HasFactory;
    protected $fillable = ['shape', 'client_id', 'confirmed'];
    public function client()
    {
        return $this->belongsTo(CarpentryClient::class);
    }
}
