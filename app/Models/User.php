<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomVerifyEmail;

class User extends Authenticatable implements MustVerifyEmailContract
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id_users';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'phone',
        'gender',
        'address',
        'avatar',
        'role',
        'is_active',
        'email_verified_at',
        'last_login_at',
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
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Relations
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'id_users', 'id_users');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, 'id_users', 'id_users');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'id_users', 'id_users');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'id_users', 'id_users');
    }

    public function whatsappLogs(): HasMany
    {
        return $this->hasMany(WhatsappLog::class, 'id_users', 'id_users');
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class, 'id_users', 'id_users');
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new CustomVerifyEmail());
    }

    public function sendPasswordResetNotification($token)
    {
        $resetUrl = url(route('password.reset', [
            'token' => $token,
            'email' => $this->email
        ]));

        $this->notify(new \App\Notifications\CustomResetPassword($resetUrl, $this));
    }

    public function hasVerifiedEmail(): bool
    {
        return !is_null($this->email_verified_at);
    }
}
