<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name_en', 'name_fr', 'name_ar', 'monthly_price', 'yearly_price', 'max_locations', 'max_users'];

    public function Subscribtion()
    {
        return $this->hasOne(Subscribtion::class);
    }
}
