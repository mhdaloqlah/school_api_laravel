<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class mark extends Model
{
    /** @use HasFactory<\Database\Factories\MarkFactory> */
    use HasFactory;
    protected $fillable = [
        'student_id',
        'teacher_id',
        'term_id',
        'year_id',
        'material_id',
        'work_mark',
        'exam_mark'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(student::class, 'student_id');
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(material::class, 'material_id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(teacher::class, 'teacher_id');
    }
}
