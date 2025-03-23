<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'birth_place',
        'user_id',
        'image',
        'education',
        'status'
    ];

    public function materials(): HasMany
    {
        return  $this->hasMany(teacher_material::class, 'teacher_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
