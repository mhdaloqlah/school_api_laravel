<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Http\Requests\StoregradeRequest;
use App\Http\Requests\UpdategradeRequest;
use App\Http\Resources\GradeResource;
use App\Models\student;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $grades = QueryBuilder::for(grade::class)
                ->allowedIncludes(['materials', 'students'])
                ->get();
            $success['data'] = new GradeResource($grades);
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
    public function store(StoregradeRequest $request)
    {

        try {
            $validated = $request->validated();
            $grade = grade::create($validated);
            $success['data'] = new GradeResource($grade);
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
    public function show(grade $grade)
    {
        try {


            $success['data'] = new GradeResource($grade);
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdategradeRequest $request, grade $grade)
    {
        try {

            $validated = $request->validated();
            $grade->update($validated);
            $success['data'] = new GradeResource($grade);
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
    public function destroy(grade $grade)
    {
        try {

           
                $grade->delete();
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
