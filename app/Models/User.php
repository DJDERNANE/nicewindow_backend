<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'master_id',
        'firstname',
        'lastname',
        'email',
        'email_verified_at',
        'password',
        'type',
        'status',
        'phone_number',
        'profile_photo_path',
        'phone_number_verified_at',
        'company_name',
        'company_logo_path',
        'api_token',
        'device_token',
        'logo',
        'otp_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'device_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function carpentry_profile_order()
    {
        return $this->hasOne(CarpentryProfileOrder::class);
    }

    public function user_locations()
    {
        return $this->hasMany(UserLocation::class);
    }

    public function carpentry_profiles_order_cart()
    {
        return $this->hasOne(CarpentryProfilesOrderCart::class);
    }

    public function carpentry_favorite_supplier()
    {
        return $this->hasOne(CarpentryFavoriteSupplier::class);
    }

    public function supplier_profile_stock()
    {
        return $this->hasOne(SupplierProfileStock::class);
    }

    public function estimate_order()
    {
        return $this->hasOne(EstimateOrder::class);
    }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
    public function credits()
    {
        return $this->hasMany(Credit::class);
    }

    public function clients()
    {
        return $this->hasMany(SupplierClient::class);
    }

    public function glasscarpentry()
    {
        return $this->hasMany(GlassCarpentry::class);
    }
    public function volles()
    {
        return $this->hasMany(Volle::class);
    }
    public function aluminium()
    {
        return $this->hasMany(Aluminium::class);
    }

    

    public function carpentryClientOrders()
    {
        return $this->hasMany(CarpentryClientOrder::class);
    }
}