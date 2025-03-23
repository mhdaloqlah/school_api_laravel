<?php

namespace Database\Seeders;

use App\Models\grade;
use App\Models\material;
use App\Models\subclass;
use App\Models\teacher;
use App\Models\student;
use App\Models\teacher_material;
use App\Models\term;
use App\Models\User;
use App\Models\year;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        year::create(['name' => '2024-2025']);
        term::create(['name' => 'الفصل الأول']);
        term::create(['name' => 'الفصل الثاني']);

        grade::create(['name' => 'الصف الأول']);
        grade::create(['name' => 'الصف الثاني']);
        grade::create(['name' => 'الصف الثالث']);
        grade::create(['name' => 'الصف الرابع']);
        grade::create(['name' => 'الصف الخامس']);
        grade::create(['name' => 'الصف السادس']);

        subclass::create(['name' => 'الشعبة الأولى']);
        subclass::create(['name' => 'الشعبة الثانية']);
        subclass::create(['name' => 'الشعبة الثالثة']);
        subclass::create(['name' => 'الشعبة الرابعة']);
        subclass::create(['name' => 'الشعبة الخامسة']);

        User::create([
            'username' => 'admin',
            'password' => 'admin2024',
            'type' => 'admin'
        ]);

        User::create([
            'username' => 'mhd',
            'password' => 'teacher2024',
            'type' => 'teacher'
        ]);
        teacher::create([
            'first_name' => 'محمد',
            'last_name' => 'فواز',
            'birth_date' => '1984-04-28',
            'birth_place' => 'دمشق',
            'user_id' => 2,
            'image' => null,
            'education' => 'علم أحياء'
        ]);


        User::create([
            'username' => 'kinaz',
            'password' => 'student2024',
            'type' => 'student'
        ]);
        student::create([
            'first_name' => 'كناز',
            'last_name' => 'سعيد',
            'father' => 'سامر',
            'mother' => 'منى',
            'birth_date' => '2018-01-01',
            'birth_place' => 'دمشق',
            'user_id' => 3,
            'image' => null,
            'grade_id' => 1,
            'subclass_id' => 1,
            'register_year_id' => 1,
            'register_term_id' => 1
        ]);

        material::create([
            'name' => 'رياضيات',
            'min' => 10 ,
            'max' => 20,
            'grade_id' => 1
        ]);
        material::create([
            'name' => 'عربي',
            'min' => 10 ,
            'max' => 20,
            'grade_id' => 1
        ]);
        material::create([
            'name' => 'علوم',
            'min' => 10 ,
            'max' => 20,
            'grade_id' => 1
        ]);


        teacher_material::create([
            'teacher_id' => 1,
            'material_id' => 1
        ]);
    }
}
