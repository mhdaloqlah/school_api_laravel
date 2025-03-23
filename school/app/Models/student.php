<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;
    protected $fillable = [
        'first_name','last_name','father','mother','birth_date','birth_place',
        'user_id','image','grade_id','subclass_id','register_year_id','register_term_id',
        'status'
    ];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(grade::class, 'grade_id', 'id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
