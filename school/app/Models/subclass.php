<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subclass extends Model
{
    /** @use HasFactory<\Database\Factories\SubclassFactory> */
    use HasFactory;
    protected $fillable=['name'];


}
