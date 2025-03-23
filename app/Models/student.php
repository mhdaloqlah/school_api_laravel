<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'father',
        'mother',
        'birth_date',
        'birth_place',
        'user_id',
        'image',
        'grade_id',
        'subclass_id',
        'register_year_id',
        'register_term_id',
        'status',
        'address',
        'phone'
    ];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(grade::class, 'grade_id', 'id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function subclass(): BelongsTo
    {
        return $this->belongsTo(subclass::class, 'subclass_id', 'id');
    }

    public function register_year(): BelongsTo
    {
        return $this->belongsTo(year::class, 'register_year_id', 'id');
    }

    public function register_term(): BelongsTo
    {
        return $this->belongsTo(term::class, 'register_term_id', 'id');
    }

    public function marks(): HasMany
    {
        return $this->hasMany(grade::class, 'student_id');
    }
}
