<?php

use App\Models\Employee;
use Illuminate\Database\Seeder;
use App\User;
//use App\Models\Employee;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'first_name'=>'Aakash',
            'last_name'=>'Bashyal'
        ]);
        
        $user->assignRole('administrator');
        
        $employee = Employee::create([
            'first_name'=>'Aakash',
            'last_name'=>'Bashyal',
            'email' => 'admin@admin.com'
        ]);
        
        $user->employee()->save($employee);

    }
}
