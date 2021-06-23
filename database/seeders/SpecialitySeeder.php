<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('specialities')->get()->count() != 0) {
            DB::table('specialities')->delete();
        }
        DB::table('specialities')->insert([
            [
                'name' => 'Allergy and immunology',
            ],
            [
                'name' => 'Anesthesiology',
            ],
            [
                'name' => 'Dermatology',
            ],
            [
                'name' => 'Diagnostic radiology',
            ],
            [
                'name' => 'Emergency medicine',
            ],
            [
                'name' => 'Family medicine',
            ],
            [
                'name' => 'Internal medicine',
            ],
            [
                'name' => 'Medical genetics',
            ],
            [
                'name' => 'Neurology',
            ],
            [
                'name' => 'Nuclear medicine',
            ],
            [
                'name' => 'Obstetrics and gynecology',
            ],
            [
                'name' => 'Ophthalmology',
            ],
            [
                'name' => 'Pathology',
            ],
            [
                'name' => 'Physical medicine and rehabilitation',
            ],
            [
                'name' => 'Preventive medicine',
            ],
            [
                'name' => 'Psychiatry',
            ],
            [
                'name' => 'Radiation oncology',
            ],
            [
                'name' => 'Surgery',
            ],
            [
                'name' => 'Urology',
            ],
        ]);
    }
}
