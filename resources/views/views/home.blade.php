@extends('layouts.app')

@section('content')
<main role="main" class="container">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kusims";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$student=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(id) AS NumberOfStudent FROM Student"));
$school=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(id) AS NumberOfSchool FROM School"));
$course=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(id) AS NumberOfCourse FROM Course"));
$staff=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(id) AS NumberOfStaff FROM Employee"));
$department=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(id) AS NumberOfDepartment FROM Department"));
?>

<div class="Ribbon">
        <table style="border: collapse; background-color: #6F42C1; font-size: 20px; color: white; text-align: center; border-radius: 5px; size: 100%,10%;" cellpadding="10">
          <tr>
            <th style="width: 22%;">Students</th>
            <th style="width: 22%;">Staffs</th>
            <th style="width: 22%;">Courses</th>
            <th style="width: 22%;">Schools</th>
            <th style="width: 22%;">Departments</th>
          </tr>
          <tr>
            <td style="width: 22%;"><?php echo $student['NumberOfStudent']; ?></td>
            <td style="width: 22%;"><?php echo $staff['NumberOfStaff']; ?></td>
            <td style="width: 22%;"><?php echo $course['NumberOfCourse']; ?></td>
            <td style="width: 22%;"><?php echo $school['NumberOfSchool']; ?></td>
            <td style="width: 22%;"><?php echo $department['NumberOfDepartment']; ?></td>
          </tr>
        </table>
      </div>

      <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="/img/ku-logo.png" alt="" width="48" height="48">
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">Notice Board</h6>
        </div>
      </div>
      
      <div class="my-3 p-3 bg-white rounded box-shadow" style="overflow: hidden;">
          <div style="width: 100%; height:80%; overflow: hidden;">
<iframe src="https://ku.edu.np/news-app?search_category=3&search_school=10&show_on_home=1"style="position: relative; width: 100%; height: 1500px; top: -300px; border: none;"></iframe>
</div>
      </div>
    </main>
@endsection
