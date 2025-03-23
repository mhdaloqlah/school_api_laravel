<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\grade;
use App\Models\material;
use App\Models\student;
use App\Models\subclass;
use App\Models\teacher;
use App\Models\User;
use App\Models\year;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{


    public function admindashboard()
    {
        try {
            
            $studentCount = QueryBuilder::for(student::class)->count();
            $teacherCount = QueryBuilder::for(teacher::class)->count();
            $materialCount = QueryBuilder::for(material::class)->count();
            $gradeCount = QueryBuilder::for(grade::class)->count();
            $subclassCount = QueryBuilder::for(subclass::class)->count();
            $currentYear =  QueryBuilder::for(year::class)->get()->last();
           
            $success['student_count']= $studentCount;
            $success['teacher_count']= $teacherCount;
            $success['material_count']= $materialCount;
            $success['grade_count']= $gradeCount;
            $success['subclass_count']= $subclassCount;
            $success['year_current']= $currentYear->name;
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }

    public function index()
    {
        try {
            $users = QueryBuilder::for(user::class)
                ->allowedFilters([AllowedFilter::exact('id')])
                ->allowedIncludes(['teacher', 'student'])
                ->get();
            $success['data'] = new UserCollection($users);
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }

    public function show(User $user)
    {
        try {
            $success['data'] = new UserResource($user);
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',

        ]);

        if (!Auth::attempt($validated)) {
            return response()->json([
                'message' => 'login information invalid',

            ], 401);
        }

        $user = User::where('username', $request['username'])->first();
        $image = '';
        $first_name = '';
        $object_id = '';
        if ($user->type == 'teacher') {
            $teacher = teacher::where('user_id', $user->id)->first();
            $image = $teacher->image;
            $first_name = $teacher->first_name;
            $object_id = $teacher->id;
        }
        if ($user->type == 'student') {
            $student = student::where('user_id', $user->id)->first();
            $image = $student->image;
            $first_name = $student->first_name;
            $object_id = $student->id;
        }
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $user,
            'user_type' => $user->type,
            'user_image' => $image,
            'first_name' => $first_name,
            'object_id' => $object_id,
            'message' => 'login successfully'
        ], 200);
    }

    public function register(Request $request)
    {


        $validateUser = Validator::make(
            $request->all(),
            [
                'username' => 'required|max:255|unique:users,username',
                'password' => 'required|confirmed|min:6',
                'type' => 'required'
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'type' => $request->type

        ]);


        $success['token'] = $user->createToken('api_token')->plainTextToken;
        $success['token_type'] = 'Bearer';
        $success['userdata'] = $user;
        $success['success'] = true;

        return response()->json($success, 200);
    }

    public function logout(Request $request)
    {
        return response()->json([
            'message' => 'successfully logged out'
        ]);
    }


    public function changePassword(Request $request)
    {
        try {
            $id = $request->id;
            $object = User::find($id);
            $object->password = Hash::make($request->password);
            $object->save();
            $success['data'] = 'password updated successfully';
            $success['data2'] = $object->password;
            $success['data3'] = $request->id;
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $id = $request->id;
            $object = User::find($id);
            $object->password = Hash::make('school2025');
            $object->save();
            $success['data'] = 'password updated successfully';
            $success['success'] = true;
            return response()->json($success, 200);
        } catch (\Throwable $th) {
            $success['error'] = $th->getMessage();
            $success['success'] = false;
            return response()->json($success, 500);
        }
    }
}
