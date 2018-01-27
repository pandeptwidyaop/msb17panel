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
        // $this->call(UsersTableSeeder::class);
        $this->call(UserSeed::class);
        //$this->call(SectionSeed::class);
        //$this->call(ConceptSeed::class);
        //$this->call(AspectSeed::class);
        //$this->call(EvaluationSeed::class);
        //$this->call(AASeeder::class);
        factory(App\Candidate::class,26)->create();
    }
}
