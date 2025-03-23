<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class subclass extends Model
{
    /** @use HasFactory<\Database\Factories\SubclassFactory> */
    use HasFactory;
    protected $fillable=['name'];
    public function students():HasMany{
        return $this->hasMany(student::class,'subclass_id','id');
    }

}
