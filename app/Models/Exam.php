<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $table = 'exams';

    protected $fillable =[
        'select_semester',
        'exam_type',
        'user_id'
    ];
}
