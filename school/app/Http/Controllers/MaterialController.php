<?php

namespace App\Http\Controllers;

use App\Models\material;
use App\Http\Requests\StorematerialRequest;
use App\Http\Requests\UpdatematerialRequest;

class MaterialController extends Controller
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
    public function store(StorematerialRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatematerialRequest $request, material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(material $material)
    {
        //
    }
}
