<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'retype_password',
        'first_name',
        'middle_name',
        'last_name',
        'phone_number',
        'otp',
        'email_verified_at',
        'role',
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
    //One to Many 
    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    // One to Many
    public function manages(): HasMany{
        return $this->hasMany(Manage::class);
    }

// One to One relationship
    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }


    public function students(): HasOne{
        return $this->hasOne(Student::class);
    }
 
    // public function passwordResetOpt(){
    //     return $this->hasMany(PasswordResetOtp::class);
    // }
    //adding the magic methods in User Model
    // public function __set($key, $value){
    //     if($key === 'email'){
    //         $value = strtolower($value);
    //     }
    //     // if($key === 'password'){
    //     //     $value = bcrypt($value);
    //     // }
    // parent::__set($key, $value);
    // }


     //mutaotars to set first name into Uppercase
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtoupper($value);
    }

    // Accessor for getting fullname

    // public function getFullNameAttribute(){
    //     return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    // }

    protected $appends = ['full_name'];

    public function getFullNameAttribute(){
        return $this->first_name .' '. $this->middle_name . ' ' .$this->last_name;
    }
}    

