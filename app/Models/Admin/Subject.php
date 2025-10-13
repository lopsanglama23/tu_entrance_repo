<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = [
        'course',
        'course_code',
        'course_credit',
        'semester',
    ];
}
