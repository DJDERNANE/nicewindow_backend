<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'user_type', 'address', 'latitude', 'longitude', 'responsible_name', 'responsible_mobile'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
