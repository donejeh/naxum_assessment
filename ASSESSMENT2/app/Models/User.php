<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function order()
    {
        return $this->hasMany(Order::class,'id','purchaser_id');
    }

    public function product() 
    {
        return $this->belongsToMany(
            Product::class, 
            'order_items', 
            'order_id', 
            'product_id'
        )->withPivot('qantity');;
    }

    public function categories(){
    return $this->belongsToMany(
        Category::class, 
        'user_category', 
        'user_id', 
        'category_id'
    );
}

    /**
     * getFullnameAttribute
     * users full name
     * @return void
     */
    public function getFullnameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


}
