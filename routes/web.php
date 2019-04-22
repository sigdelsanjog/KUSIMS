<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');
Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('profile', 'UserProfileController@index')->name('user.profile');
Route::get('profile/teacher/course/{id}', 'UserProfileController@getCourses');

Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallback');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
});

Route::group(['middleware' => ['auth'], 'prefix' => 'setting', 'as' => 'setting.'], function () {
    Route::resource('school', 'SchoolController');
    Route::resource('department', 'DepartmentController');
    Route::resource('courses', 'CourseController');
    Route::post('courses_mass_destroy', ['uses' => 'CourseController@massDestroy', 'as' => 'courses.mass_destroy']);
    Route::post('courses_restore/{id}', ['uses' => 'CourseController@restore', 'as' => 'courses.restore']);
    Route::delete('courses_perma_del/{id}', ['uses' => 'CourseController@perma_del', 'as' => 'courses.perma_del']);
    Route::resource('batches', 'BatchesController');
    Route::post('batches_mass_destroy', ['uses' => 'BatchesController@massDestroy', 'as' => 'batches.mass_destroy']);
    Route::post('batches_restore/{id}', ['uses' => 'BatchesController@restore', 'as' => 'batches.restore']);
    Route::delete('batches_perma_del/{id}', ['uses' => 'BatchesController@perma_del', 'as' => 'batches.perma_del']);

    Route::resource('jobtypes', 'JobtypesController');
    Route::post('jobtypes_mass_destroy', ['uses' => 'JobtypesController@massDestroy', 'as' => 'jobtypes.mass_destroy']);
    Route::post('jobtypes_restore/{id}', ['uses' => 'JobtypesController@restore', 'as' => 'jobtypes.restore']);
    Route::delete('jobtypes_perma_del/{id}', ['uses' => 'JobtypesController@perma_del', 'as' => 'jobtypes.perma_del']);

    Route::resource('employees', 'EmployeesController');
    Route::post('employees_mass_destroy', ['uses' => 'EmployeesController@massDestroy', 'as' => 'employees.mass_destroy']);
    Route::post('employees_restore/{id}', ['uses' => 'EmployeesController@restore', 'as' => 'employees.restore']);
    Route::delete('employees_perma_del/{id}', ['uses' => 'EmployeesController@perma_del', 'as' => 'employees.perma_del']);

    Route::resource('programs', 'ProgramsController');
    Route::post('programs_mass_destroy', ['uses' => 'ProgramsController@massDestroy', 'as' => 'programs.mass_destroy']);
    Route::post('programs_restore/{id}', ['uses' => 'ProgramsController@restore', 'as' => 'programs.restore']);
    Route::delete('programs_perma_del/{id}', ['uses' => 'ProgramsController@perma_del', 'as' => 'programs.perma_del']);

});

Route::group(['middleware' => ['auth'], 'prefix' => 'manage', 'as' => 'manage.'], function () {
    Route::resource('students', 'StudentsController');
    Route::post('students_mass_destroy', ['uses' => 'StudentsController@massDestroy', 'as' => 'students.mass_destroy']);
    Route::post('students_restore/{id}', ['uses' => 'StudentsController@restore', 'as' => 'students.restore']);
    Route::delete('students_perma_del/{id}', ['uses' => 'StudentsController@perma_del', 'as' => 'students.perma_del']);
    Route::get('student_create/upload', ['uses' => 'StudentsController@upload', 'as' => 'students.upload']);
   
    

    Route::post('bulkstore', ['uses' => 'StudentsController@bulkstore', 'as' => 'students.bulkstore']); 
});

Route::group(['middleware' => ['auth'], 'prefix' => 'hostel', 'as' => 'hostel.'], function () {
    Route::resource('block', 'HostelBlockController');
    Route::resource('room', 'HostelRoomController');
    Route::resource('book', 'HostelBookController');

    Route::post('hostelblocks_mass_destroy', ['uses' => 'HostelBlockController@massDestroy', 'as' => 'block.mass_destroy']);
    Route::post('hostelblocks_restore/{id}', ['uses' => 'HostelBlockController@restore', 'as' => 'block.restore']);
    Route::delete('hostelblocks_perma_del/{id}', ['uses' => 'HostelBlockController@perma_del', 'as' => 'block.perma_del']);

    Route::post('hostelrooms_mass_destroy', ['uses' => 'HostelRoomController@massDestroy', 'as' => 'room.mass_destroy']);
    Route::post('hostelrooms_restore/{id}', ['uses' => 'HostelRoomController@restore', 'as' => 'room.restore']);
    Route::delete('hostelrooms_perma_del/{id}', ['uses' => 'HostelRoomController@perma_del', 'as' => 'room.perma_del']);

});


Route::post('/manage/student/imageupload', 'StudentsController@imgUpload');
Route::post('/setting/teacher/course', 'EmployeesController@assignCourse');
Route::post('/setting/teacher/course', 'EmployeesController@assignCourse');
// Route::post('/setting/teacher/removecourse', 'EmployeesController@deleteAssignCourse');

Route::delete('/setting/teacher/removecourse', 'EmployeesController@deleteAssignCourse');
Route::get('/manage/student/studentdocs/{id}', 'StudentsController@getStudentDoc');
Route::post('/student/docsupload', 'StudentsController@studentDocUpload');
Route::post('/student/approveDoc', 'StudentsController@approveDoc');
Route::get('/student/getaddress/{id}', 'StudentsController@pullStudentAddress');
Route::post('/student/address', 'StudentsController@postStudentAddress');



Route::get('/student/getmarks/{id}', 'StudentsController@pullStudentMarks');
Route::get('/student/getqualification/{id}', 'StudentsController@pullStudentQualification');
Route::post('/student/qualification', 'StudentsController@postStudentQualification');

Route::get('/hostel/book_block', 'HostelBookController@pullHostelBlock');
Route::get('/hostel/book_room', 'HostelBookController@pullHostelRoom');
Route::post('/hostel/hostel_status', 'HostelBookController@postHostelStatus');

Route::post('/employee/marksupload', 'EmployeesController@bulkStoreMarks');

// Route::group(['middleware'=> 'web'],function(){
//     Route::resource('school','\App\Http\Controllers\SchoolController');
//     Route::post('school/{id}/update','\App\Http\Controllers\SchoolController@update');
//     Route::get('school/{id}/delete','\App\Http\Controllers\SchoolController@destroy');
//     Route::get('school/{id}/deleteMsg','\App\Http\Controllers\SchoolController@DeleteMsg');
//   });



Route::group(['middleware' => ['auth']], function () {
    Route::resource('notice', 'NoticeController');
});