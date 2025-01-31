<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribtion extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'start', 'end', 'package_id', 'status', 'file', 'created_by'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
