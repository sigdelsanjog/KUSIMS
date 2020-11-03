<?php

use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::create([
        	'name' => 'Engineering',
        	'address' => 'Dhulikhel',
        	'phone' => '+977-11-415100',
        	'email' => 'dean_engg@ku.edu.np',
        	'contact_person' => 'Dr. Damber Bahadur Nepali',
        	'contact_person_phone' => '+977-11-415011',
        	'status' => 1,
        	'notes' => 'Please contact before visiting'
        ]);

        School::create([
        	'name' => 'Science',
        	'address' => 'Dhulikhel',
        	'phone' => '+977-11-415200',
        	'email' => 'kusos_dean@ku.edu.np',
        	'contact_person' => 'Prof. Dr. Kanhaiya Jha',
        	'contact_person_phone' => '+977-11-415011',
        	'status' => 1,
        	'notes' => 'Please contact before visiting'
        ]);

         School::create([
        	'name' => 'Education',
        	'address' => 'Hattiban',
        	'phone' => '+977-1-5250524',
        	'email' => 'admin@kusoed.edu.np',
        	'contact_person' => 'Prof. Dr. Mahesh Nath Parajuli',
        	'contact_person_phone' => '+977-1-5251306',
        	'status' => 1,
        	'notes' => 'Please contact before visiting'
        ]);

         School::create([
        	'name' => 'Arts',
        	'address' => 'Hattiban',
        	'phone' => '+977-1-5251294',
        	'email' => 'kusoa@ku.edu.np',
        	'contact_person' => 'Dr. Sagar Raj Sharma',
        	'contact_person_phone' => '+977-1-5251306',
        	'status' => 1,
        	'notes' => 'Please contact before visiting'
        ]);

         School::create([
        	'name' => 'Law',
        	'address' => 'Dhulikhel',
        	'phone' => '+977-11-490735',
        	'email' => 'kusl@ku.edu.np',
        	'contact_person' => 'Dr. Rishikesh Wagle',
        	'contact_person_phone' => '+977-11-490196',
        	'status' => 1,
        	'notes' => 'Please contact before visiting'
        ]);

         School::create([
        	'name' => 'Management',
        	'address' => 'Balkumari',
        	'phone' => '+977-1-5186091',
        	'email' => 'info@kusom.edu.np',
        	'contact_person' => 'Prof. Dr. Bijay KC',
        	'contact_person_phone' => '+977-1-5186029',
        	'status' => 1,
        	'notes' => 'Please contact before visiting'
        ]);

    
         School::create([
        	'name' => 'Medical Sciences',
        	'address' => 'Dhulikhel',
        	'phone' => '+977-11-490497',
        	'email' => 'kusms@ku.edu.np',
        	'contact_person' => 'Prof. Dr. Rajendra Koju',
        	'contact_person_phone' => '+977-11-490777',
        	'status' => 1,
        	'notes' => 'Please contact before visiting'
        ]); 
	}
}