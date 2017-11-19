<?php

use Illuminate\Database\Seeder;

class GenreTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genre_tbl')->insert([
            'name' => 'Action',
            'desc' => 'Action description'
        ]);
        DB::table('genre_tbl')->insert([
            'name' => 'Thiller',
            'desc' => 'Thiller description'
        ]);
        DB::table('genre_tbl')->insert([
            'name' => 'Comedy',
            'desc' => 'Comedy description'
        ]);
        DB::table('genre_tbl')->insert([
            'name' => 'TV',
            'desc' => 'TV description'
        ]);

        
    }
}
