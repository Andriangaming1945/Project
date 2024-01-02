<?php 

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Model;

$factory->define(\App\Models\Siswa::class, function (Faker $faker){

    return [
        'user_id' => 100,
        'nama_depan' => $faker->name,
        'nama_belakang' => '',
        'jenis_kelamin' => $faker->randomElement(['L', 'P']),
        'agama' => $faker->randomElements(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
        'alamat' => $faker->address,
    ];
});

?>