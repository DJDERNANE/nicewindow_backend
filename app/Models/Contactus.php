<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'phone_number', 'email', 'subject', 'message', 'ip', 'status'];

    protected $table = 'contactus';
}
