<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo('users_manage');
        $role->givePermissionTo('hostel_access');
        
        $role->givePermissionTo('department_create');
        $role->givePermissionTo('department_edit');
        $role->givePermissionTo('department_delete');
        
        $role->givePermissionTo('employee_access');
        $role->givePermissionTo('employee_edit');
        $role->givePermissionTo('employee_view');
        $role->givePermissionTo('employee_create');
        $role->givePermissionTo('employee_delete');
        
        $role->givePermissionTo('jobtype_access');
        $role->givePermissionTo('jobtype_create');
        $role->givePermissionTo('jobtype_edit');
        $role->givePermissionTo('jobtype_view');
        $role->givePermissionTo('jobtype_delete');
        
        $role->givePermissionTo('course_access');
        $role->givePermissionTo('course_edit');
        $role->givePermissionTo('course_create');
        $role->givePermissionTo('course_view');
        $role->givePermissionTo('course_delete');
        
        $role->givePermissionTo('student_access');
        $role->givePermissionTo('student_create');
        $role->givePermissionTo('student_edit');
        $role->givePermissionTo('student_view');
        $role->givePermissionTo('student_delete');
        
        $role->givePermissionTo('program_access');
        $role->givePermissionTo('program_create');
        $role->givePermissionTo('program_edit');
        $role->givePermissionTo('program_view');
        $role->givePermissionTo('program_delete');
        
        $role->givePermissionTo('batch_create');
        $role->givePermissionTo('batch_access');
        $role->givePermissionTo('batch_edit');
        $role->givePermissionTo('batch_view');
        $role->givePermissionTo('batch_delete');
        
        $role->givePermissionTo('hostelblock_access');
        $role->givePermissionTo('hostelblock_delete');
        $role->givePermissionTo('hostelblock_create');
        $role->givePermissionTo('hostelblock_edit');
        $role->givePermissionTo('hostelblock_view');
        
        $role->givePermissionTo('hostelroom_access');
        $role->givePermissionTo('hostelroom_create');
        $role->givePermissionTo('hostelroom_edit');
        $role->givePermissionTo('hostelroom_view');
        $role->givePermissionTo('hostelroom_delete');   
        
        $role->givePermissionTo('setting_access');       
       
    }
}
