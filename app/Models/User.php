<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use App\Models\Role;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasFactory, Notifiable, HasApiTokens;

  protected $fillable = [
    'name',
    'username',
    'email',
    'phone',
    'password',
    'address',
    'profile_image',
    'remember_token',
    'role_id',
    'status',
    'verification_code',
    'verification_code_expires_at',
    'is_verified',
  ];

  protected $hidden = [
    'password',
    'remember_token',
    'verification_code'
  ];

  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
      'verification_code_expires_at' => 'datetime',
      'is_verified' => 'boolean',
    ];
  }


  protected $appends = ['profile_image_url'];

  public function role()
  {
    return $this->belongsTo(Role::class);
  }

  public function isAdmin()
  {
    return $this->role->name === 'Admin';
  }

  public function isCustomer()
  {
    return $this->role->name === 'User';
  }

  public function orders()
  {
    return $this->hasMany(Order::class);
  }

  public function getProfileImageUrlAttribute()
  {
    if ($this->profile_image) {
      return asset($this->profile_image);
    }
    return asset('images/default-profile_image.png');
  }

  /**
   * Generate a new verification code
   */
  public function generateVerificationCode(): string
  {
    $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

    $this->update([
      'verification_code' => $code,
      'verification_code_expires_at' => Carbon::now()->addMinutes(10), // Expires in 10 minutes
    ]);

    return $code;
  }

  /**
   * Verify the provided code
   */
  public function verifyCode(string $code): bool
  {
    if (
      $this->verification_code === $code &&
      $this->verification_code_expires_at &&
      Carbon::now()->isBefore($this->verification_code_expires_at)
    ) {

      $this->update([
        'is_verified' => true,
        'email_verified_at' => Carbon::now(),
        'verification_code' => null,
        'verification_code_expires_at' => null,
      ]);

      return true;
    }

    return false;
  }

  /**
   * Check if verification code is expired
   */
  public function isVerificationCodeExpired(): bool
  {
    return $this->verification_code_expires_at &&
      Carbon::now()->isAfter($this->verification_code_expires_at);
  }

  /**
   * Check if user has verified email
   */
  public function hasVerifiedEmail(): bool
  {
    return $this->is_verified;
  }
}
