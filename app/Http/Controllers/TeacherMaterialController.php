<?php

namespace App\Http\Controllers;

use App\Models\teacher_material;
use App\Http\Requests\Storeteacher_materialRequest;
use App\Http\Requests\Updateteacher_materialRequest;
use App\Http\Resources\Teacher_MaterialResource;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class TeacherMaterialController extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = QueryBuilder::for(teacher_material::class)
                ->allowedFilters(['teacher_id', 'material_id'])
                ->allowedIncludes(['teacher', 'material.grade'])->get();
            $success['data'] = new Teacher_MaterialResource($data);
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeteacher_materialRequest $request)
    {
        try {
            $validated = $request->validated();

            $checkIfexist = teacher_material::where('teacher_id', $validated['teacher_id'])
                ->where('material_id', $validated['material_id'])->first();

            if (!$checkIfexist) {
                $teacher_material = teacher_material::create($validated);
                $success['data'] = new Teacher_MaterialResource($teacher_material);
                $success['success'] = true;
                return response()->json($success, 200);
            } else {

                $success['data'] = 'this operation already registered';
                $success['success'] = false;
                return response()->json($success, 200);
            }
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(teacher_material $teacher_material)
    {
        try {

            $success['data'] = new Teacher_MaterialResource($teacher_material);
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(teacher_material $teacher_material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateteacher_materialRequest $request, teacher_material $teacher_material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(teacher_material $teacher_material)
    {
        try {
           
            // $teacher_material = teacher_material::find($id);
            $teacher_material->delete();
            $success['data'] = 'Delete successfully';
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }
}
