<?php

/*
|--------------------------------------------------------------------------
| Menu Factory
|--------------------------------------------------------------------------
*/

$factory->define(\SierraTecnologia\Cms\Models\Menu::class, function (Faker\Generator $faker) {
    return [

        'id' => 1,
        'name' => 'dumb menu',
        'slug' => 'testerSLUG',
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),

    ];
});
