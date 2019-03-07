<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        Permission::create(['name' => 'users_manage']);

        Permission::create(['name' => 'department_create']);
        Permission::create(['name' => 'department_edit']);
        Permission::create(['name' => 'department_delete']);

        Permission::create(['name' => 'employee_access']);
        Permission::create(['name' => 'employee_edit']);
        Permission::create(['name' => 'employee_create']);
        Permission::create(['name' => 'jobtype_access']);
        Permission::create(['name' => 'course_access']);
        Permission::create(['name' => 'course_edit']);
        Permission::create(['name' => 'course_create']);
        Permission::create(['name' => 'course_delete']);

        Permission::create(['name' => 'employee_delete']);
        Permission::create(['name' => 'student_access']);
        Permission::create(['name' => 'batch_create']);
        Permission::create(['name' => 'batch_access']);
        Permission::create(['name' => 'student_edit']);

        Permission::create(['name' => 'program_access']);
        Permission::create(['name' => 'program_create']);
        Permission::create(['name' => 'program_edit']);
        Permission::create(['name' => 'setting_access']);
    }
}
