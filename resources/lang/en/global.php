<?php

return [
	
	'user-management' => [
		'title' => 'User Management',
		'created_at' => 'Time',
		'fields' => [
		],
	],
	'batch' => [
		'title' => 'Batch',
		'fields' => [
			'year' => 'Year',
			'description' => 'Description',
		],
	],
	'permissions' => [
		'title' => 'Permissions',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
		],
	],
	'course' => [
		'title' => 'Course',
		'fields' => [
		],
	],
	'jobtype' => [
        'title' => 'Job Type',
        'fields' => [
            'name' => 'Name',
            'description' => 'Description',
        ],
	],
	
	'roles' => [
		'title' => 'Roles',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
			'permission' => 'Permissions',
		],
	],
	'employee' => [
        'title' => 'Employee',
        'fields' => [
            'first-name' => 'First Name',
            'middle-name' => 'Middle Name',
            'last-name' => 'Last Name',
            'job' => 'Employee Type',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'dept' => 'Department',
            'qualification' => 'Qualification',
        ],
    ],
	'users' => [
		'title' => 'Users',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Password',
			'roles' => 'Roles',
			'remember-token' => 'Remember token',
			'user-type' => 'User Type',
		],
	],
	'course' => [
		'title' => 'Course',
		'fields' => [
			'name' => 'Name',
			'code' => 'Code',
			'description' => 'Description',
			'status' => 'Status',
		],
	],
	'student' => [
		'title' => 'Student',
		'fields' => [
			'first-name' => 'First name',
			'middle-name' => 'Middle Name',
			'last-name' => 'Last Name',
			'phone' => 'Phone',
			'mobile-phone' => 'Mobile phone',
			'gender' => 'Gender',
			'nationality' => 'Nationality',
			'citizenship-no' => 'Number',
			'citizenship-issue-place' => 'Isssue Place',
			'citizenship-issue-date' => 'Isssue Date',
			'email' => 'Email',
			'date-of-birth' => 'Date of birth',
			'batch' => 'Batch',
			'dept' => 'Department',
			'reg-no' => 'Registration Number'
		],
	],

	'program' => [
		'title' => 'Program',
		'fields' => [
			'name' => 'Program Name',
			'description' => 'Description',
		],
	],
	'hostel' => [
		'title' => 'Hostel',
		'fields' => [
		],
	],
	'notice' => [
		'title' => 'Notice',
		'fields' => [
			'title' => 'Title',
			'description' => 'Description',
			'user-type' => 'User Type',
			'from-date' => 'From Date',
			'to-date' => 'To Date'
		],
	],
	
	'hostelblock' => [
		'title' => 'Hostel Block',
		'fields' => [
			'name' => 'Name',
			'location' => 'Location',
			'incharge' => 'Incharge',
			'contact' => 'Contact',
		],
	],
	
	'hostelroom' => [
		'title' => 'Hostel Room',
		'fields' => [
			'block' => 'Block',
			'room' => 'Room',
		],
	],
	'buspage' => [
		'title' => 'Bus Page',
	],
	'app_change_password' => 'Change password',
	'app_create' => 'Create',
	'app_save' => 'Save',
	'app_edit' => 'Edit',
	'app_view' => 'View',
	'app_update' => 'Update',
	'app_list' => 'List',
	'app_no_entries_in_table' => 'No entries in table',
	'custom_controller_index' => 'Custom controller index.',
	'app_logout' => 'Logout',
	'app_add_new' => 'Add new',
	'app_are_you_sure' => 'Are you sure?',
	'app_back_to_list' => 'Back to list',
	'app_dashboard' => 'Dashboard',
	'app_delete' => 'Delete',
	'global_title' => 'Kathmandu University SIMS',
	'app_all'=>'All',
	'app_trash'=>'Trash',

	'app_restore' => 'Restore',
	'app_permadel' => 'Delete Permanently',
	
	'app_no_entries_in_table' => 'No entries in table',

	'app_please_select' => 'Please select',
];