<?php

namespace App\Models;

use App\Models\Admin\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'student_photo',
        'student_signature',
        'first_name',
        'middle_name',
        'last_name',
        'first_name_dev',
        'middle_name_dev',
        'last_name_dev',
        'father_name',
        'mother_name',
        'gender',
        'marital_status',
        'date_of_birth_bs',
        'date_of_birth_ad',
        'user_id'
    ];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function getStudentPhotoUrlAttribute(){
        return $this->student_photo ? asset('storage/' . $this->student_photo) : null;
    }
    public function getStudentSignatureUrlAttribute(){
        if($this->student_signature){
            return asset('storage/' . $this->student_signature);
        }
        return null;
    } 

    // Using the __get magic methods for getting dynamic full_name and And full_name_dev
    // protected $appends = ['student_photo_url','student_signature_url'];
    // public function __get($key){
    //     if($key === 'full_name'){
    //         return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    //     }
    //     if($key === 'full_name_dev'){
    //         return trim("{$this->first_name_dev} {$this->middle_name_dev} {$this->last_name_dev}");
    //     }
    // }
    
    // One to One relationship
    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }
}
