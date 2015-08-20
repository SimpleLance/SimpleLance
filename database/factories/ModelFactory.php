<?php

$factory->define(SimpleLance\User::class, function ($faker) {
    return [
        'email'    => $faker->email,
        'username' => $faker->name,
        'password' => Hash::make($faker->word),
        'is_admin' => true,
    ];
});
