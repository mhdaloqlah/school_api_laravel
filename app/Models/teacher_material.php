<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class teacher_material extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherMaterialFactory> */
    use HasFactory;
    protected $fillable = ['teacher_id', 'material_id'];

    public function teacher():BelongsTo{
        return $this->belongsTo(teacher::class,'teacher_id');
    }

    public function material():BelongsTo{
        return $this->belongsTo(material::class,'material_id');
    }
}
