<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create([
            $admin = 'name' => 'admin'
        ]);
        $student = Role::create(['
        name' => 'student'
        ]);

        $receptionist = Role::create([
            $receptionist = 'name' => 'receptionst'
        ]);

        $buffet_owner = Role::create([
            $buffet_owner = 'name' => 'buffet_owner'
        ]);


        // إنشاء الصلاحيات لكل كيان في النظام
        $this->applyCRUDs('room');        // إدارة الغرف
        $this->applyCRUDs('table');       // إدارة الطاولات
        // $this->applyCRUDs('booking');     // إدارة الحجوزات
        // $this->applyCRUDs('package');     // إدارة البكجات
        // $this->applyCRUDs('user');        // إدارة المستخدمين
        $this->applyAdminPermissions($admin);
        // $this->applyBuffet_ownerPermissions($buffet_owner);
        // $this->applyStudentPermissions($student);
        $this->applyReceptionistPermissions($receptionist);


    }
    private function applyCRUDs(string $name)
    {
        $permissions = [];
        $crudList = [
            'index',
            'create',
            'update',
            'show',
            'delete'
        ];
        foreach ($crudList as $crud) {
            array_push($permissions, $name . '.' . $crud);
        }
        foreach ($permissions as $per) {
            Permission::create([
                'name' => $per
            ]);
        }

    }

    //   صلاحيات المدير (كل الصلاحيات)

    private function applyAdminPermissions(Role $admin): void
    {
        $permissions = Permission::all();
        $admin->permissions()->attach($permissions);
    }


    private function applyReceptionistPermissions(Role $receptions): void
    {
        $permissions = Permission::whereIn('name', [
            'room.index',
            'room.show',

            'table.index',
            'table.show',
            'room.update',
            'table.update',

        ])->get();

        $receptions->permissions()->attach($permissions);
    }


}
