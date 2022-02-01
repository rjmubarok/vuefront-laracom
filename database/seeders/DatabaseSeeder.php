<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        $superAdmin = \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@email.com',
            'password' => Hash::make('superadmin')
            
        ]);
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin')
        ]);
        // \App\Models\User::factory(10)->create();

        // Role seeder
        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'admin']);

        //assign role
        $superAdmin->assignRole('super-admin');
        $admin->assignRole('admin');

        // Permission seeder
        Permission::create(['name'=>'user-crud']);
        Permission::create(['name'=>'create-user']);
        Permission::create(['name'=>'read-user']);
        Permission::create(['name'=>'update-user']);
        Permission::create(['name'=>'delete-user']);
        
        Permission::create(['name'=>'create-category']);
        Permission::create(['name'=>'read-category']);
        Permission::create(['name'=>'update-category']);
        Permission::create(['name'=>'delete-category']);
        
        Permission::create(['name'=>'create-product']);
        Permission::create(['name'=>'read-product']);
        Permission::create(['name'=>'update-product']);
        Permission::create(['name'=>'delete-product']);
    }
}