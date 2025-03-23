<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'min'=>$this->min,
            'max'=>$this->max,
            'grade_id'=>$this->grade_id,
            'grade_name'=>$this->grade->name,
            'teachers' =>$this->teachers,
            'marks_count'=> count($this->marks),
            'teachers_count' =>count($this->teachers),

        ];
    }
}
