<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class term extends Model
{
    /** @use HasFactory<\Database\Factories\TermFactory> */
    use HasFactory;
    protected $fillable = ['name'];
    public function marks(): HasMany
    {
        return $this->hasMany(mark::class, 'term_id');
    }
    public function students(): HasMany
    {
        return $this->hasMany(student::class, 'register_term_id');
    }
}
