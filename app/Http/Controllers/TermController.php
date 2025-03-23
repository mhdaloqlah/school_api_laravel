<?php

namespace App\Http\Controllers;

use App\Models\term;
use App\Http\Requests\StoretermRequest;
use App\Http\Requests\UpdatetermRequest;
use App\Http\Resources\TermResource;
use Spatie\QueryBuilder\QueryBuilder;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $terms = QueryBuilder::for(term::class)->get();
            $success['data'] = new TermResource($terms);
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
    public function store(StoretermRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(term $term)
    {
        try {
            $success['data'] =  new  TermResource($term);
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
    public function edit(term $term)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetermRequest $request, term $term)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(term $term)
    {
        //
    }
}
