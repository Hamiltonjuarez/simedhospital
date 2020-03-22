<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

class DatabaseSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = __DIR__.'/';
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->seed('DataTypesTableSeeder');
        $this->seed('DataRowsTableSeeder');
        $this->seed('MenusTableSeeder');
        $this->seed('MenuItemsTableSeeder');
        $this->seed('RolesTableSeeder');
        $this->seed('PermissionsTableSeeder');
        $this->seed('PermissionRoleTableSeeder');
        $this->seed('SettingsTableSeeder');
        /* $this->truncatetablas([
            'usuario'
        ]); */
        /* $this->call(UserTableSeeder::class);
        $this->call(DoctorTableSeeder::class);
        $this->call(PacienteTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(Procedimiento_tipoTableSeeder::class); */


        //$this->call(CitasTableSeeder::class);

    }
    protected function truncatetablas(array $tablas)
    {
        foreach ($tablas as $tabla)
        {
            DB::table($tabla)->truncate();
        }
    }
}
