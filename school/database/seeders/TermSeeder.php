<?php

namespace Database\Seeders;

use App\Models\term;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        term::create(['name'=>'الفصل الأول']);
        term::create(['name'=>'الفصل الثاني']);
    }
}
