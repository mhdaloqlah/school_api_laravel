<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Http\Requests\StoregradeRequest;
use App\Http\Requests\UpdategradeRequest;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdategradeRequest $request, grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(grade $grade)
    {
        //
    }
}
