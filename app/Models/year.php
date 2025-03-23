<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class year extends Model
{
    /** @use HasFactory<\Database\Factories\YearFactory> */
    use HasFactory;
    protected $fillable = ['name'];
    public function marks(): HasMany
    {
        return $this->hasMany(mark::class, 'year_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(student::class, 'register_year_id');
    }
}
