<?php

namespace App\Http\Controllers;

use App\Models\teacher;
use App\Http\Requests\StoreteacherRequest;
use App\Http\Requests\UpdateteacherRequest;
use App\Http\Resources\TeacherCollection;
use App\Http\Resources\TeacherResource;
use App\Models\teacher_material;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $teachers = QueryBuilder::for(teacher::class)->allowedFilters(['user_id'])->get();
            $success['data'] = new TeacherCollection($teachers);
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }

    public function teacherMaterial(Request $request)
    {
        try {
            $teacher_id = $request->teacher_id;
            $material_id = $request->material_id;

            $check = teacher_material::where('teacher_id', $teacher_id)
                ->where('material_id', $material_id)
                ->first();

            if ($check) {
                $success['data'] = 'teacher id and material exist';
                $success['success'] = false;
                return response()->json($success, 200);
            } else {
                $object = teacher_material::create([
                    'teacher_id' => $teacher_id,
                    'material_id' => $material_id
                ]);
                $success['data'] = $object;
                $success['success'] = true;
                return response()->json($success, 200);
            }
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }

    public function deleteTeacherMaterial(Request $request)
    {
        try {
            $id = $request->id;
            $object = teacher_material::find($id);
            $object->delete();
            $success['data'] = 'object deleted successfully';
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
    public function store(StoreteacherRequest $request)
    {
        try {
            $validated = $request->validated();
            $image = null;
            if ($request->image != null) {
                $image = Str::random(32) . "." . $request->image->getClientOriginalExtension();
                Storage::disk('public')->put($image, file_get_contents($request->image));
                $validated['image'] = $image;
            }
            // error_log($validated['username']);
            $user = User::create([
                'username' => $validated['username'],
                'type' => 'teacher',
                'password' => Hash::make('teacher2024')
            ]);
            $teacher = teacher::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'birth_date' => $validated['birth_date'],
                'birth_place' => $validated['birth_place'],
                'user_id' => $user->id,
                'education' => $validated['education'],
                'image' =>  $image
            ]);
            $success['data'] = new TeacherResource($teacher);
            $success['user_data'] = $user;
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
    public function show(teacher $teacher)
    {
        try {
            $teacherData = QueryBuilder::for(teacher::class)
            ->allowedIncludes(['materials',])
            ->where('id',$teacher->id)->first();
            $success['data'] = new TeacherResource($teacher);
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
    public function update(UpdateteacherRequest $request, teacher $teacher)
    {
        try {
            $validated = $request->validated();
            $image = null;
            if ($request->image != null) {
                $image = Str::random(32) . "." . $request->image->getClientOriginalExtension();
                Storage::disk('public')->put($image, file_get_contents($request->image));
                $validated['image'] = $image;
            }
            error_log($request['first_name']);
            // $teacher->update(['first_name' => $validated['first_name'],
            //     'last_name' => $validated['last_name'],
            //     'birth_date'=>$validated['birth_date'],
            //     'birth_place'=>$validated['birth_place'],
            //     'education'=>$validated['education'],
            //     'image'=> $validated['image']]);
            $success['data'] = new TeacherResource($teacher);
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }

    public function updateteacher(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'sometimes|max:255|string',
                'last_name' => 'sometimes|max:255|string',
                'birth_date' => 'sometimes',
                'birth_place' => 'sometimes|max:255|string',
                'image' => 'sometimes',
                'education' => 'sometimes',
                'status' => 'sometimes',
                'id' => 'required'
            ]);
            $image = null;
            if ($request->image != null) {
                $image = Str::random(32) . "." . $request->image->getClientOriginalExtension();
                Storage::disk('public')->put($image, file_get_contents($request->image));
                $validated['image'] = $image;
            }
            error_log($request['first_name']);
            $teacher = teacher::find($validated['id']);
            $teacher->update($validated);
            $success['data'] = new TeacherResource($teacher);
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
    public function destroy(teacher $teacher)
    {
        try {

            $user = User::find($teacher->user_id);
            $user->delete();
            $teacher->delete();

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
