<?php

namespace App\Http\Controllers;

use App\Models\year;
use App\Http\Requests\StoreyearRequest;
use App\Http\Requests\UpdateyearRequest;
use App\Http\Resources\YearResource;
use Spatie\QueryBuilder\QueryBuilder;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $years = QueryBuilder::for(year::class)->get();
            $success['data'] = new YearResource($years);
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
    public function store(StoreyearRequest $request)
    {
        try {
            $validated = $request->validated();
            $year = year::create($validated);
            $success['data'] =  new  YearResource($year);
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
    public function show(year $year)
    {
        try {
            $success['data'] =  new  YearResource($year);
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
    public function update(UpdateyearRequest $request, year $year)
    {
        try {
            $validated = $request->validated();
            $year->update($validated);
            $success['data'] =  new  YearResource($validated);
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
    public function destroy(year $year)
    {
        try {
            $year->delete();
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
