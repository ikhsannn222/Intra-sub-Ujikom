<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    //
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Masukin permission baru disini
        $collection = collect([
            'User',
            'Role',
            'Permission',
            'Departement',
            'Bagian',
            'Jabatan',
            'TaskStatus',
            'TaskType',
            'TaskPriorities',
            'ProjectStatuses',
            'Activities',
            'Project',
            'AttachUser',
            'Tasks',
            'Board',
            'Kanban',
        ]);

        $subPermission = collect([
            'view',
            'create',
            'edit',
            'delete',
        ]);

        $collection->each(function ($item, $key) use ($subPermission) {
            Permission::updateOrCreate(
                ['name' => 'manage' . $item],
                ['guard_name' => 'web', 'name' => 'manage' . $item]
            );
            $subPermission->each(function ($subItem, $subKey) use ($item) {
                Permission::updateOrCreate(
                    ['name' => 'manage' . $item . '-' . $subItem],
                    ['guard_name' => 'web', 'name' => 'manage' . $item . '-' . $subItem]
                );
            });
        });

        // Membuat atau memperbarui pengguna admin
        $userAdmin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Unique identifier
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'), // Hanya update password jika perlu
                'nrp' => '1234',
            ]
        );

        // Membuat atau memperbarui role superadmin
        $roleAdmin = Role::updateOrCreate(['name' => 'superadmin']);
        $roleAdmin->givePermissionTo(Permission::all()); // Memberikan semua permission kepada superadmin
        $userAdmin->assignRole($roleAdmin);

        // Membuat atau memperbarui pengguna staff
        $userTeacher = User::updateOrCreate(
            ['email' => 'staff@gmail.com'], // Unique identifier
            [
                'name' => 'Staff',
                'password' => bcrypt('password'), // Hanya update password jika perlu
                'nrp' => '123',
            ]
        );

        // Membuat atau memperbarui role staff
        $roleTeacher = Role::updateOrCreate(['name' => 'staff']);

        // Memberikan permission tertentu untuk staff
        $roleTeacher->givePermissionTo(Permission::whereIn('id', ['71', '76', '77'])->get());
        $userTeacher->assignRole($roleTeacher);

        // membuat role manager
        $roleManager = Role::updateOrCreate(['name' => 'role-manager']);
        $roleManager->givePermissionTo([]);

        $userManager = User::updateOrCreate(
            ['email' => 'manager@gmail.com'],
            [
                'name' => 'Role Manager',
                'password' => bcrypt('password'),
                'nrp' => '456',
            ]
        );
        $userManager->assignRole($roleManager);

    }
}
