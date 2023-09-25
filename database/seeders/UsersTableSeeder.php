<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::truncate();
        User::truncate();
        Role::truncate();

        $adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);
        $WriterRole = Role::create(['name' => 'Writer','display_name' => 'Escritor']);

        $viewPostsPermission = Permission::create(['name' => 'View posts','display_name' => 'Ver publicaciones']);
        $createPostsPermission = Permission::create(['name' => 'Create posts','display_name' => 'Crear publicaciones']);
        $updatePostsPermission = Permission::create(['name' => 'Update posts','display_name' => 'Actualizar publicaciones']);
        $deletePostsPermission = Permission::create(['name' => 'Delete posts','display_name' => 'Eliminar publicaciones']);

        $viewUsersPermission = Permission::create(['name' => 'View users','display_name' => 'Ver usuarios']);
        $createUsersPermission = Permission::create(['name' => 'Create users','display_name' => 'Crear usuarios']);
        $updateUsersPermission = Permission::create(['name' => 'Update users','display_name' => 'Actualizar usuarios']);
        $deleteUsersPermission = Permission::create(['name' => 'Delete users','display_name' => 'Eliminar usuarios']);

        $viewRolesPermission = Permission::create(['name' => 'View roles','display_name' => 'Ver roles']);
        $createRolesPermission = Permission::create(['name' => 'Create roles','display_name' => 'Crear roles']);
        $updateRolesPermission = Permission::create(['name' => 'Update roles','display_name' => 'Actualizar roles']);
        $deleteRolesPermission = Permission::create(['name' => 'Delete roles','display_name' => 'Eliminar roles']);

        $viewPermissionsPermission = Permission::create(['name' => 'View permissions','display_name' => 'Ver permisos']);
        $updatePermissionsPermission = Permission::create(['name' => 'Update permissions','display_name' => 'Actualizar permisos']);


        $admin = new User;
        $admin->name = 'Angel Mamani';
        $admin->email = 'angel@aprendible.com';
        $admin->password = bcrypt('angel123');
        $admin->save();

        $admin->assignRole($adminRole);

        $writer = new User;
        $writer->name = 'Miguel Condori';
        $writer->email = 'miguel@aprendible.com';
        $writer->password = bcrypt('miguel123');
        $writer->save();

        $writer->assignRole($WriterRole);
    }
}
