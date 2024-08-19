<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierClient extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone', 'email', 'company_name','supplier_id'];
    
    public function supplier()
    {
        return $this->belongsTo(User::class);
    }
}
