<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class usuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Administrator','guard_name' => 'web']);
        Role::create(['name' => 'Client','guard_name' => 'web']);

        $user = User::create([
            'firstName'=>'Super',
            'secondName'=>'',
            'Surname'=>'Usuario',
            'secondSurname'=>'Administrador',
            'documentType'=>'Cedula de ciudadanía',
            'documentNumber'=>'1069179367',
            'email'=>'superAdmin@admin.com',
            'password'=>Hash::make('12345678'),
        ]);
        $user->assignRole('Administrator');
    }
}
