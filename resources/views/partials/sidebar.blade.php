<div class="sidebar">
   <nav class="sidebar-nav">
      <ul class="nav">
         <li class="nav-item">
            <a class="nav-link active" href="/">
            <i class="nav-icon icon-speedometer"></i> Dashboard
            </a>
         </li>
         
         @can('users_manage')
         <li class="nav-divider"></li>
         <li class="nav-title">User</li>
         <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon fas fa-users text-danger"></i></i>@lang('global.user-management.title')</a>
            <ul class="nav-dropdown-items">
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.permissions.index') }}" target="_top">
                  <i class="nav-icon icon-briefcase"></i>  @lang('global.permissions.title')</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.roles.index') }}" target="_top">
                  <i class="nav-icon fas fa-tasks"></i> @lang('global.roles.title')</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.users.index') }}" target="_top">
                  <i class="nav-icon far fa-user"></i>@lang('global.users.title')</a>
               </li>
            </ul>
         </li>
         @endcan

         @can('setting_access')
         <li class="nav-divider"></li>
         <li class="nav-title">Settings</li>
         <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon icon-settings text-warning"></i>Setting</a>
            <ul class="nav-dropdown-items">
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('setting.school.index') }}" target="_top">
                  <i class="nav-icon fas fa-school"></i>School</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('setting.department.index') }}" target="_top">
                  <i class="nav-icon far fa-building"></i>Department</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('setting.courses.index') }}" target="_top">
                  <i class="nav-icon icon-notebook"></i>Course</a>
               </li>               
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('setting.batches.index') }}" target="_top">
                  <i class="nav-icon far fa-calendar-times"></i>Batch</a>
               </li>               
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('setting.jobtypes.index') }}"  target="_top">
                  <i class="nav-icon icon-people"></i>Job Type</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('setting.employees.index') }}"  target="_top">
                  <i class="nav-icon fas fa-user-tie"></i>Employee</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('setting.programs.index') }}"  target="_top">
                  <i class="nav-icon fas fa-tasks"></i>Program</a>
               </li>
            </ul>
         </li>
         @endcan
         @can('student_access')
         <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon fas fa-users text-info"></i></i>Student</a>
            <ul class="nav-dropdown-items">
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('manage.students.index') }}" target="_top">
                  <i class="nav-icon fas fa-user-graduate"></i>Student</a>
               </li>
            </ul>
         </li>
         @endcan
         <li class="nav-item">
            <a class="nav-link active" href="/profile">
            <i class="nav-icon fas fa-user"></i> Profile
            </a>
         </li>
      </ul>
   </nav>
   <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>