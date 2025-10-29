<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Storage;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'citizenship_no',
        'citizenship_copy',
        'district',
        'permanent_address',
        'contact_address',
        'contact_landline',
        'contact_phone',
        'user_id'
    ];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    // //accessor class for getting the 
    // public function getCitizenshipCopyUrlAttribute(){
    //     if($this->citizenship_copy){
    //         return asset('/storage'.$this->citizenship_copy);
    //     }
    //     return null;
    // }

    // protected $appends = ['citizen_copy_url'];
}
