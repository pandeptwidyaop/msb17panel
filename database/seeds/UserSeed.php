<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'name' => 'Pande Putu Widya Oktapratama',
          'email' => 'widya.oktapratama@gmail.com',
          'password' => '$2y$10$ssZTFGk8WlBb.qdDn4eGUub30Q5BjlaXaz13M3hQJps/mqaHnhEPO',
          'role' => 'admin'
        ]);
    }
}
