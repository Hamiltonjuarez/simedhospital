<?php
use App\Procedimiento_tipo;
use Illuminate\Database\Seeder;

class Procedimiento_tipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Procedimiento_tipo::create([
            'procedimiento_nombre' => 'Colonoscopía',
        ]);
        Procedimiento_tipo::create([
            'procedimiento_nombre' => 'Gastroscopía',
        ]);
        Procedimiento_tipo::create([
            'procedimiento_nombre' => 'Ultrasonografía',
        ]);
    }
}
