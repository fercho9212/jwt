<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('users')->insert([
        'name'      =>  'Ferney Jerez',
        'email'     =>  'ferney9212@gmail.com',
        'password'  =>   bcrypt('FERfer123.'),
      ]);

      \DB::table('drivers')->insert([
        'name'      =>  'Driver ',
        'email'     =>  'driver@gmail.com',
        'last'     =>   'Last Driver ',
        'password'  =>   bcrypt('123.'),
      ]);
    }
}
