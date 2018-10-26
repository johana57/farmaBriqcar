<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;

class PermisologiaDefaultseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('¿Desea actualizar la migración antes de la inicialización? Tenga en cuenta que borrará todos los datos antiguos.')){
            $this->command->call('migrate:refresh');
            $this->command->warn("Datos eliminados, empezando una base de datos nueva...");
        }
        
        $permissions = Permission::defaultPermissions();
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => trim($permission)]);
        }
        $this->command->info('Permisos agregados con exito.');
      
        // Creando el Rol
        $roles =  Role::defaultRole();
        // add roles
        foreach($roles as $role) {
            $role = Role::firstOrCreate(['name' => trim($role)]);
            if( $role->name == 'Administrador' ) {
                $role->permissions()->sync(Permission::all());
                $this->command->info('El rol Administrador posee todos los permisos.');
            }
            // create one user for each role
            $this->createUser($role);
        }
        $this->command->info('Rol' . $role . ' creado con exito.');

    }
    
    private function createUser($role)
    {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);
        if( $role->name == 'Administrador' ) {
            $this->command->info('Detalles del usuario:');
            $this->command->warn('Username : '.$user->username);
//            $this->command->warn('Username : '.$user->email);
            $this->command->warn('Password : "secret"');
        }
    }
}