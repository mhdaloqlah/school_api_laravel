<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class grade extends Model
{
    /** @use HasFactory<\Database\Factories\GradeFactory> */
    use HasFactory;
    protected $fillable=['name'];

    public function materials():HasMany{
        return $this->hasMany(material::class,'grade_id','id');
    }
    public function students():HasMany{
        return $this->hasMany(student::class,'grade_id','id');
    }

}
