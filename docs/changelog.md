## Change Log

Contributors are encouraged to add the changes which they have made in their PRs.
Please mention the details about your changes. You can mention whether it is a feature update, bug fix, documentation update etc.

Once you add your change log here your PR will be merged to the main repository.

## Changes By CE2016 group
***Prashanna Adhikari . Shailesh Adhikari . Bisheshwor Bhatta . Sumit Chaudhary***

### Database Seeding and Migration
Data needed after the initial installation has been seeded. Data for schools, departments and courses available in the official Kathmandu University Website has been seeded. Additional permissions and roles has also been seeded. The seeder is implemented as:
```
public function run()
{
$this->call(PermissionSeed::class);
$this->call(RoleSeed::class);
$this->call(UserSeed::class);
$this->call(DocumentSeeder::class);
$this->call(SchoolSeed::class);
$this->call(DepartSeed::class);
$this->call(CourseSeed::class);
}
```

### Student and Employee as Users
The students and employees uploaded by the administrator user gets uploaded into the User table giving them the user privileges in the system. This has been accomplished by making a store function that stores student or employee both in their respective table as well as the user table.

```
//for student
public function store(StoreStudentRequest $request)
{
//return student information in both user and student table
}
//for employee
public function store(StoreEmployeesRequest $request)
{
//return employee information in both user and employee table
}
```

### Sending Email to the new Users
When a new user is updated in the system, an Email is sent to the user notifying them about their username and password which they can use to access the system. The Mail API provided by Laravel itself has been used for enabling SMTP driver in the system. Using this, mail can be sent to any mail host like gmail, yahoo or mail trap.
A new class NewMail has been made which is extended from Mailable class of the Mail API. It is defined as:
```
class NewMail extends Mailable
{
public function __construct($username,$password)
{
//Retrieving username and password from users
}
public function build()
{
//returning information to the respective view
}
}
The mail is sent to the student or employee during the storing process:
public function store(StoreStudentRequest $request)
{
$user = new \App\User();
$useremail = $request[‘email’];
$email = $useremail;
$password = //password;
Mail::to($email)send(new NewMail($username, $password);
}
```

The emails are sent to bulk students and employees in the similar fashion.

### Importing and Exporting Students and Employees
Students are imported in bulks using a library of PHP known as the PHPExcel_IOFactory and MySQLi extension. The PHPExel_IOFactory retrieves the file to be imported, which are looped through rows and the data are retrieved and stored in SQL table using the MySQLi extension.

```public function bulkstore(Request $request)
{
//requesting access to the database
$fileData = $requestfile('file');
$objPHPExcel = PHPExcel_IOFactory::load($fileData);
//iterating through the file
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
{
//retreiving each column through MySQLi extension
// saving information on the SQL table
}
}
```

For exporting tables to local devices, a simple but elegant Laravel wrapper known as Laravel-Excel has been used. It is an open source wrapper available at GitHub. The repository link is:
https://github.com/Maatwebsite/Laravel-Excel
A class UsersExport has been defined that implements FromArray module of Laravel-Excel that converts array to an Excel file.

```
class UsersExport implements FromArray
{ protected $invoices;
public function __construct(array $invoices){
$this->invoices = $invoices;
}
public function array(): array{
return $this->invoices;
}
}
```

### Feedback Module
A new module for Feedback has been developed. Feedback enables communication between the students and the employees. There are two permission enables in feedback. One is to send the feedback, and the other one is to view the feedback. Sending feedback is enabled to users with roles of students and viewing feedback is enabled to users with roles of employees.
In the feedback sending section, a section for typing feedbacks and options of employees to whom the feedbacks can be send is provided. The view sends this information to the system using the POST method.
The feedback controller provides a create() method for the sendng feedback view.
```
public function create()
{ $employees = Employee::all();
$employees = $employees->mapWithKeys(function ($item){
return [$item['id'] => $item['first_name']." ".$item['last_name']];
});
return view('feedbacks.create',compact('employees'));
}
```

The feedback controller provides a savemsg() method for saving information in the feedback table. The feedback table stores employee id, student id and message sent by the student.
```
public function savemsg(Request $request){
$feedbacks = new \App\Feedback();
$feedbacks->message = $request['feedback'];
$feedbacks->teacher_id = $request['employee'];
$feedbacks->student_id = Auth::id();
$feedbacks->save();
$employees = Employee::all();
$employees = $employees->mapWithKeys(function ($item){
return [$item['id'] => $item['first_name']." ".$item['last_name']];
});
return view('feedbacks.create',compact('employees'));
}
```
In the feedback viewing section, the employee can view what feedbacks has been sent to them and who has sent those feedbacks. The feedback controller provides show() method for the view.
```
public function show(){
$id = Auth::user()->employee->id;
if(Auth::user()->user_type=="Employee")
$recieves = Feedback::all()->where('teacher_id',$id)->pluck('message');
elseif(Auth::user()->user_type=="Student")
$recieves = Feedback::all()->where('student_id',Auth::id())->pluck('message');
else
$recieves = Feedback::all()->where('teacher_id', $id)->pluck('message');
return view('feedbacks.show',compact('recieves'));
}
```
### Dashboard Section
The dashboard section has been updated with updated Notice board and the university statistics. It provides information about the number of students, number of staffs, number of courses offered, number of schools and number of departments. The data is retrieved from the number of information stored in the SQL database.
