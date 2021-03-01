<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Admin;
use App\Models\User;
use App\Models\UserKYC;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(UserKYC::class, function (Faker $faker){

    $user = User::inRandomOrder()->first();

    return [
        'first_name' => $faker->firstName,
        'middle_name' => null,
        'last_name' => $faker->lastName,
        'fathers_name' => $faker->firstNameMale . ' ' . $faker->lastName,
        'mothers_name' => $faker->firstNameFemale . ' ' . $faker->lastName,
        'grand_fathers_name' => $faker->firstNameMale . ' ' . $faker->lastName,
        'spouce_name' => $faker->name,
        'province' => (string)rand(1, 7),
        'district' => $faker->randomElement(['kathmandu', 'lalitpur', 'bhaktapur', 'pokhara']),
        'municipality' => $faker->randomElement(['kathmandu', 'lalitpur', 'bhaktapur', 'pokhara']),
        'zone' => $faker->randomElement(['zone1', 'zone2', 'zone3', 'zone4']),
        'tole' => (string) rand(10, 50),
        'id_no' => (string) rand(123456789, 999999999),
        'c_issued_date' => (string) $faker->date('Y-m-d', 'now'),
        'c_issued_from' => $faker->randomElement(['kathmandu', 'lalitpur', 'bhaktapur', 'pokhara']),
        'p_photo' => null,
        'c_photo' => null,
        'o_photo' => null,
        'gender' => $faker->randomElement(['m', 'f', 'o']),
        'user_id' =>  $faker->unique()->numberBetween(User::first()->id,User::latest()->first()->id),
        'status' => $faker->randomElement([1,0])
    ];
});


