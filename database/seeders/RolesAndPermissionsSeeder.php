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

        $receptionist = Role::create([
            $receptionist = 'name' => 'receptionsr'
        ]);

        $buffet_owner = Role::create([
            $buffet_owner = 'name' => 'buffet_owner'
        ]);


        // إنشاء الصلاحيات لكل كيان في النظام
        $this->applyCRUDs('room');        // إدارة الغرف
        $this->applyCRUDs('table');       // إدارة الطاولات
        $this->applyCRUDs('booking');     // إدارة الحجوزات
        $this->applyCRUDs('package');     // إدارة البكجات
        $this->applyCRUDs('user');        // إدارة المستخدمين


    }
    private function applyCRUDs(string $name)
    {
        $permissions = [];
        $crudList = [
            'index',
            'create',
            'update',
            'show'
        ];
        // foreach ($crudList as $crud) {
        //     array_push($permissions, $name . '.' . $crud);
        // }
        // foreach ($permissions as $per) {
        //     Permission::create([
        //         'name' => $per
        //     ]);
        // }



    }
}
