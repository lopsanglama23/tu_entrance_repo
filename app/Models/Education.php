<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    use HasFactory;
    protected $table = 'educations';
    protected $fillable = [
        'your_degree',
        'board_name',
        'major_subject',
        'academic_year',
        'division_grade',
        'complete_years',
        'user_id',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
