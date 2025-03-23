<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Http\Requests\StorestudentRequest;
use App\Http\Requests\UpdatestudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\error;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $students = QueryBuilder::for(student::class)
                ->allowedIncludes(['grade', 'subclass'])
                ->allowedFilters(['subclass_id', 'grade_id'])->get();
            $success['data'] = new StudentResource($students);
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
    public function store(StorestudentRequest $request)
    {
        try {
            $validated = $request->validated();
            $image = null;
            if ($request->image != null) {
                $image = Str::random(32) . "." . $request->image->getClientOriginalExtension();
                Storage::disk('public')->put($image, file_get_contents($request->image));
                $validated['image'] = $image;
            }

            $user = User::create([
                'username' => $validated['username'],
                'type' => 'student',
                'password' => Hash::make('student2024')
            ]);

            error($validated['birth_date']);
            error($user->id);
            $student = student::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'father' => $validated['father'],
                'mother' => $validated['mother'],
                'birth_date' => $validated['birth_date'],
                'birth_place' => $validated['birth_place'],
                'user_id' => $user->id,
                'grade_id' => $validated['grade_id'],
                'subclass_id' => $validated['subclass_id'],
                'register_year_id' => $validated['register_year_id'],
                'register_term_id' => $validated['register_term_id'],
                'image' => $image,
                'address' => $validated['address'],
                'phone' => $validated['phone'],

            ]);
            $success['data'] = new StudentResource($student);
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
    public function show(student $student)
    {
        try {
            $studentData = QueryBuilder::for(student::class)
            ->allowedIncludes(['grade', 'subclass','register_term','register_year'])
            ->where('id',$student->id)->first();
            $success['data'] = new StudentResource($studentData);
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
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatestudentRequest $request, student $student)
    {
        //
    }

    public function updatestudent(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'sometimes|max:255|string',
                'last_name' => 'sometimes|max:255|string',
                'father' => 'sometimes|max:255|string',
                'mother' => 'sometimes|max:255|string',
                'birth_date' => 'sometimes',
                'birth_place' => 'sometimes|max:255|string',
                'image' => 'sometimes',
                'grade_id' => 'sometimes',
                'subclass_id' => 'sometimes',
                'register_year_id' => 'sometimes',
                'register_term_id' => 'sometimes',
                'status' => 'sometimes',
                'id' => 'required',
                'address' => 'sometimes|max:255|string',
                'phone' => 'sometimes|max:255|string',
            ]);
            $image = null;
            if ($request->image != null) {
                $image = Str::random(32) . "." . $request->image->getClientOriginalExtension();
                Storage::disk('public')->put($image, file_get_contents($request->image));
                $validated['image'] = $image;
            }
            error_log($request['first_name']);
            $student = student::find($validated['id']);
            $student->update(
                $validated
            );
            $success['data'] = new StudentResource($student);
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
    public function destroy(student $student)
    {
        try {

            $user = User::find($student->user_id);
            $user->delete();
            $student->delete();

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
