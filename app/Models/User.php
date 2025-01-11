<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'role', 'email', 'phone', 'password', 'address', 'identity_number', 'image', 'family_size', 'position', 'status', 'wife_name', 'wife_identity_number'];

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

    public function distributions()
    {
        return $this->hasMany(Distribution::class);
    }

    /**
     * Scope for employees.
     */
    public function scopeEmployees($query)
    {
        return $query->where('role', 'employee');
    }

    /**
     * Scope for admins.
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope for owners.
     */
    public function scopeSuperAdmin($query)
    {
        return $query->where('role', 'super_admin');
    }
    public function scopeAdminsAndSuperAdmins($query)
    {
        return $query->where('role', 'admin')
            ->orWhere('role', 'super_admin');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function attachments()
{
    return $this->hasMany(Attachment::class);
}
}
