<?php

namespace App\Models\Admin;
use App\Models\Student;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = [
        'course',
        'course_code',
        'course_credit',
        'semester',
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }
}
