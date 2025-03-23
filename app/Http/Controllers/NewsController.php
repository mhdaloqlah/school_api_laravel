<?php

namespace App\Http\Controllers;

use App\Models\news;
use App\Http\Requests\StorenewsRequest;
use App\Http\Requests\UpdatenewsRequest;
use App\Http\Resources\NewsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\AllowedFilter;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $news = QueryBuilder::for(news::class)
                ->allowedFilters(['news_for'])
                ->defaultSort(['-news_date'])
                ->get();
            $success['data'] = new NewsResource($news);
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
    public function store(StorenewsRequest $request)
    {
        try {
            $validated = $request->validated();
            $image = null;
            if ($request->image != null) {
                $image = Str::random(32) . "." . $request->image->getClientOriginalExtension();
                Storage::disk('public')->put($image, file_get_contents($request->image));
                $validated['image'] = $image;
            }

            $news = news::create($validated);
            $success['data'] = new NewsResource($news);
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
    public function show(news $news)
    {
        try {

            $success['data'] = new NewsResource($news);
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
    public function edit(news $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatenewsRequest $request, news $news)
    {
        try {
            $validated = $request->validated();
            $image = null;
            if ($request->image != null) {
                $image = Str::random(32) . "." . $request->image->getClientOriginalExtension();
                Storage::disk('public')->put($image, file_get_contents($request->image));
                $validated['image'] = $image;
            }
            $news->update($validated);
            $success['data'] = new NewsResource($news);
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }


    public function updatenews(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'sometimes|max:255|string',
                'content' => 'sometimes|string',
                'news_date' => 'sometimes',
                'news_for' => 'sometimes|max:255|string',
                'image' => 'sometimes',
                'id' => 'required'
            ]);
            $image = null;
            if ($request->image != null) {
                $image = Str::random(32) . "." . $request->image->getClientOriginalExtension();
                Storage::disk('public')->put($image, file_get_contents($request->image));
                $validated['image'] = $image;
            }
            $news = news::find($validated['id']);
            $news->update($validated);
            $success['data'] = new NewsResource($news);
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
    public function destroy(news $news)
    {
        try {


            $news->delete();

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
