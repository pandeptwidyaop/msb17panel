<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Candidate::class, function (Faker\Generator $faker) {

    return [
        'id' => $faker->randomNumber(9),
        'number' => $faker->randomDigit,
        'name' => $faker->firstNameFemale,
        'place_of_birth' => $faker->country,
        'date_of_birth' => $faker->date(),
        'religion' => 'hindu',
        'address' => $faker->address,
        'phone_number' => $faker->phoneNumber,
        'campus' => 'renon',
        'study_program' => 'SI',
        'semester' => 'VI',
        'organization' => $faker->company,
        'organization_experience' => $faker->text,
        'achievements' => $faker->text,
        'interest_talents' => $faker->text,
        'reason' => $faker->text,
        'social_media' => $faker->safeEmail,
        'picture' => 'images/miss.jpg',
        'user_id' => 1
    ];
});
