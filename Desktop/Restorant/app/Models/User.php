<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected $appends = ['crated_at_readable'];

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function users(){
        return $this->hasMany(User::class , 'user_id');
    }

    public function categoris(){
        return $this->hasMany(Category::class , 'user_id');
    }

    public function sub_categories(){
        return $this->hasMany(Subcategory::class , 'user_id');
    }

    public function foods(){
        return $this->hasMany(Food::class , 'user_id');
    }

    public function tables(){
        return $this->hasMany(Table::class , 'user_id');
    }

    public function reservations(){
        return $this->hasMany(Ressrevation::class , 'user_id');
    }

    public function invoices(){
        return $this->hasMany(Invoice::class , 'user_id');
    }

    public function invoice_food(){
        return $this->hasMany(InvoiceFood::class , 'user_id');
    }
    

    public function getCratedAtReadableAttribute(){
        return $this->created_at?->diffForHumans();
    }

    public function getRoleReadableAttribute(){
        if ($this->role == 1) {
            return 'admin';
        } elseif ($this->role == 2) {
            return 'server';
        } else {
            return 'chef';
        }
    }

    public function isAdmin()
    {
        return $this->role == 1;
    }

    public function isServer()
    {
        return $this->role == 2;
    }

    public function isChef()
    {
        return $this->role == 3;
    }
}
