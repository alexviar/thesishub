<?php

namespace Database\Seeders;

use App\Models\Tutor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //No usar en produccion
        Tutor::factory(5)->state(new Sequence(
            ['codigo' => '1111'],
            ['codigo' => '2222'],
            ['codigo' => '3333'],
            ['codigo' => '4444'],
            ['codigo' => '5555']
        ))->create();
    }
}
