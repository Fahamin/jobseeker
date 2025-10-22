<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_questions',
        'correct_answers',
        'wrong_answers',
        'score',
        'exam_date'
    ];

    protected $casts = [
        'exam_date' => 'datetime',
        'score' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}