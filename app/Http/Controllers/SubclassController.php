<?php

namespace App\Http\Controllers;

use App\Models\subclass;
use App\Http\Requests\StoresubclassRequest;
use App\Http\Requests\UpdatesubclassRequest;
use App\Http\Resources\SubclassResource;
use Spatie\QueryBuilder\QueryBuilder;

class SubclassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $subclasses = QueryBuilder::for(subclass::class)
            ->allowedIncludes(['students'])
            ->get();
            $success['data'] = new SubclassResource($subclasses);
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
    public function store(StoresubclassRequest $request)
    {
        try {

            $validated = $request->validated();
            $subclass = subclass::create($validated);
            $success['data'] = new SubclassResource($subclass);
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
    public function show(subclass $subclass)
    {
        try {


            $success['data'] = new SubclassResource($subclass);
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
    public function update(UpdatesubclassRequest $request, subclass $subclass)
    {
        try {
            $validated = $request->validated();
            $subclass->update($validated);
            $success['data'] = new SubclassResource($subclass);
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
    public function destroy(subclass $subclass)
    {
        try {

            $subclass->delete();
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
