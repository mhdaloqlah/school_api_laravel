<?php

namespace App\Http\Controllers;

use App\Models\mark;
use App\Http\Requests\StoremarkRequest;
use App\Http\Requests\UpdatemarkRequest;
use App\Http\Resources\MarkResource;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $marks = QueryBuilder::for(mark::class)
                ->allowedIncludes(['material.grade', 'teacher', 'student'])
                ->allowedFilters([AllowedFilter::exact('student_id'), AllowedFilter::exact('year_id'), AllowedFilter::exact('term_id'), AllowedFilter::exact('material_id')])
                ->get();
            $success['data'] = new MarkResource($marks);
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }

    public function checkMark(Request $request)
    {
        try {
            $student_id = $request->student_id;
            $material_id = $request->material_id;
            $term_id = $request->term_id;
            $year_id = $request->year_id;

            $markData = mark::where('student_id', $student_id)
                ->where('material_id', $material_id)
                ->where('term_id', $term_id)
                ->where('year_id', $year_id)
                ->first();
            $success['data'] = $markData;
            $success['data 2'] = $request['student_id'];
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
    public function store(StoremarkRequest $request)
    {
        try {

            $validated = $request->validated();

            $student_id = $validated['student_id'];
            $material_id = $validated['material_id'];
            $term_id = $validated['term_id'];
            $year_id = $validated['year_id'];

            $markData = mark::where('student_id', $student_id)
                ->where('material_id', $material_id)
                ->where('term_id', $term_id)
                ->where('year_id', $year_id)
                ->first();

            if ($markData) {
                $markData->work_mark = $validated['work_mark'];
                $markData->exam_mark = $validated['exam_mark'];
                $markData->save();
                $success['data'] = new MarkResource($markData);
                $success['success'] = true;
                return response()->json($success, 200);
            } else {
                $mark = mark::create($validated);
                $success['data'] = new MarkResource($mark);
                $success['success'] = true;
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
    public function show(mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mark $mark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemarkRequest $request, mark $mark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mark $mark)
    {
        //
    }
}
