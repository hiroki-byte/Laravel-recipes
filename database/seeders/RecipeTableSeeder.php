<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RecipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('recipes')->insert(
            [
                'rid'=> 1,
                'rname'=> 'sample',
                'image'=> 'sample1',
                'rcomment'=>'null',
                'serving'=>'1'
            ]
            );
    }
}
