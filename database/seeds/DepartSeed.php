<?php

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
        	'address' => 'Dhulikhel',
        	'block' => 9,
        	'school_id' => 1,
        	'contact_person'=> 'Dr. Bal Krishna Bal',
        	'notes' => 'Please contact before visiting',
        	'phone'=> '+977-11-415100',
        	'email' => 'cse@ku.edu.np',
        	'name' => 'Computer Science and Engineering',
        	'status' => 1,
        ]);

        Department::create([
        	'address' => 'Dhulikhel',
        	'block' => 7,
        	'school_id' => 1,
        	'contact_person'=> 'Dr. Rajendra Joshi',
        	'notes' => 'Please contact before visiting',
        	'phone'=> '+977-11-661399',
        	'email' => 'kuchemicalengg@gmail.com',
        	'name' => 'Chemical Science and Engineering',
        	'status' => 1,
        ]);

        Department::create([
        	'address' => 'Hattiban',
        	'block' => 1,
        	'school_id' => 4,
        	'contact_person'=> 'Sujan Chitrakar',
        	'notes' => 'Please contact before visiting',
        	'phone'=> '+977-1-5250462',
        	'email' => 'info@kuart.edu.np',
        	'name' => 'Arts and Design',
        	'status' => 1,
        ]);

        Department::create([
        	'address' => 'Kathmandu',
        	'block' => 1,
        	'school_id' => 4,
        	'contact_person'=> 'Prog. Dr. G.M. Wegner',
        	'notes' => 'Please contact before visiting',
        	'phone'=> '+977-1-4479505',
        	'email' => 'music.department@ku.edu.np',
        	'name' => 'Music',
        	'status' => 1,
        ]);

        Department::create([
        	'address' => 'Dhulikhel',
        	'block' => 6,
        	'school_id' => 2,
        	'contact_person'=> 'Prof. Dr. Deepak Prasad Subedi',
        	'notes' => 'Please contact before visiting',
        	'phone'=> '+977-11-661399',
        	'email' => 'dsubedi@ku.edu.np',
        	'name' => 'Natural Sciences',
        	'status' => 1,
        ]);
    }
}