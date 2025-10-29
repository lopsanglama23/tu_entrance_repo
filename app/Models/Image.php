<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'photo',
        'sign',
        'citizen',
    ];
    
    public function getPhotoUrlAttribute(){
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }

    public function getSignUrlAttribute(){
        return $this->sign ? asset('storage/' . $this->sign) : null;
    }

    public function getCitizenUrlAttribute(){
        return $this->citizen ? asset('storage/' . $this->citizen) : null;
    }

    public function signUrl():Attribute{
        return Attribute::make(
            get: fn($value, $attributes) => new $attributes['sign'] ? asset('storage/'. $attributes['sign']) : null 
        );

    }
     protected $appends = ['photo_url','sign_url','citizen_url'];
}
