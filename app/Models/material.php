<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class material extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'min',
        'max',
        'grade_id'
    ];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(grade::class, 'grade_id', 'id');
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(teacher_material::class, 'material_id');
    }

    public function marks(): HasMany
    {
        return $this->hasMany(mark::class, 'material_id');
    }
}
