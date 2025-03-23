<?php
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubclassController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherMaterialController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', [UserController::class, 'login']);
Route::post('create', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout']);

Route::post('teacherMaterial', [TeacherMaterialController::class, 'teacherMaterial']);
Route::post('deleteTeacherMaterial', [TeacherMaterialController::class, 'deleteTeacherMaterial']);
Route::post('changepassword',[UserController::class,'changePassword']);
Route::post('resetPassword',[UserController::class,'resetPassword']);

Route::apiResource('term', TermController::class)->only(
    [
        'index',
        'show',
        
    ]
);

Route::apiResource('user', UserController::class)->only(
    [
        'index',
        'show',
        'store',
        'update',
        'destroy'
    ]
);


Route::apiResource('year', YearController::class)->only(
    [
        'index',
        'show',
        'store',
        'update',
        'destroy'
    ]
);

Route::apiResource('grade', GradeController::class)->only(
    [
        'index',
        'show',
        'store',
        'update',
        'destroy'
    ]
);


Route::apiResource('subclass', SubclassController::class)->only(
    [
        'index',
        'show',
        'store',
        'update',
        'destroy'
    ]
);

Route::apiResource('material', MaterialController::class)->only(
    [
        'index',
        'show',
        'store',
        'update',
        'destroy'
    ]
);


Route::apiResource('student', StudentController::class)->only(
    [
        'index',
        'show',
        'store',
        'update',
        'destroy'
    ]
);

Route::apiResource('teacher', TeacherController::class)->only(
    [
        'index',
        'show',
        'store',
        'update',
        'destroy'
    ]
);

Route::apiResource('news', NewsController::class)->only(
    [
        'index',
        'show',
        'store',
        'update',
        'destroy'
    ]
);

Route::apiResource('teacher_material', TeacherMaterialController::class)->only(
    [
        'index',
        'show',
        'store',
        'update',
        'destroy'
    ]
);

Route::apiResource('mark', MarkController::class)->only(
    [
        'index',
        'show',
        'store',
        'update',
        'destroy'
    ]
);
Route::get('/images/{filename}', [ImageController::class, 'show']);

Route::get('checkMark',[MarkController::class,'checkMark']);
Route::get('admindashboard',[UserController::class,'admindashboard']);
Route::post('updateteacher',[TeacherController::class,'updateteacher']);
Route::post('updatestudent',[StudentController::class,'updatestudent']);
Route::post('updatenews',[NewsController::class,'updatenews']);
