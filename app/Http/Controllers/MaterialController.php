<?php

namespace App\Http\Controllers;

use App\Models\material;
use App\Http\Requests\StorematerialRequest;
use App\Http\Requests\UpdatematerialRequest;
use App\Http\Resources\MaterialCollection;
use App\Http\Resources\MaterialResource;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $materials = QueryBuilder::for(material::class)
                ->allowedFilters(['grade_id', 'name','teachers.teacher_id','teachers.teacher.user_id'])
                ->allowedIncludes(['grade', 'teachers','teachers.teacher','marks'])
                ->get();
            $success['data'] = new MaterialCollection($materials);
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StorematerialRequest $request)
    {
        try {
            $validated = $request->validated();
            $material = material::create($validated);
            $success['data'] = new MaterialResource($material);
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(material $material)
    {
        try {
            $success['data'] = new MaterialResource($material);
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatematerialRequest $request, material $material)
    {
        try {
            $validated = $request->validated();
            $material->update($validated);
            $success['data'] = 'jhjhjhjh';
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }
    public function updatematerial(Request $request)
    {
        try {
            $validated = $request->validated();
            $material = material::find($request->id);
            $material->update($validated);
            $success['data'] = new MaterialResource($material);
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(material $material)
    {
        try {
            $material->delete();
            $success['data'] = 'record has been deleted';
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }
}
