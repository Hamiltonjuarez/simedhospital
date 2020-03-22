<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Factory(App\User::class, 1)->create();

        Role::create([
            'name'   =>  'Admin',
            'slug'   =>  'admin',
            'special' => 'all-access',
        ]);
        Role::create([
            'name'  => 'Doctor',
            'slug'  => 'doctor',
        ]);
        Role::create([
            'name'  => 'Asistente',
            'slug'  => 'asistente',
        ]);
       /*  Role::create([
            'name' => 'Doctor',
            'slug' => 'doctor',
            'special' => ''
        ]); */
    }
}
