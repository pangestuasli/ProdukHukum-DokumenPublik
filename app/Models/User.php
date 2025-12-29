<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profil_picture' // tambahkan ini
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Accessor untuk mendapatkan URL foto profil
     */
    public function getProfilPictureUrlAttribute()
    {
        if ($this->profil_picture && file_exists(public_path('storage/profil/' . $this->profil_picture))) {
            return asset('storage/profil/' . $this->profil_picture);
        }
        
        // Default avatar jika tidak ada foto
        return asset('images/default-avatar.png'); // sesuaikan dengan path avatar default Anda
    }

    /**
     * Mutator untuk profil picture
     */
    public function setProfilPictureAttribute($value)
    {
        $this->attributes['profil_picture'] = $value;
    }

    /**
     * Validasi rules untuk store
     */
    public static function storeRules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,user',
            'profil_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Validasi rules untuk update
     */
    public static function updateRules($id)
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:admin,user',
            'profil_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}