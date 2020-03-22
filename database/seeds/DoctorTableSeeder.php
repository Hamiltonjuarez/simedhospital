<?php

use Illuminate\Database\Seeder;
use App\Doctor;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    Doctor::create([
        'nombreDoctor' => 'Maxwell',
        'apellidosDoctor'=>'Lopez',
        'user_id'=>'1',
        'tituloDoctor'=>'Dr. Max',
        'direccion' => 'san salvador',
        'telefono' => '12345678',
        'logo' => 'uno.jpg',

    ]);

    }
}
