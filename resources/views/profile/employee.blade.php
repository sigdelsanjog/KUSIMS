@extends('layouts.app')

@section('content')
      <b-card>
        <div class="row">
          <div class="col-lg-3 pb-5">
            <!-- Account Sidebar-->
            <div class="author-card pb-3">
              <div class="author-card-profile">
                <div class="author-card-avatar">
                  <img src="storage/attachments/default_image.png" alt="Daniel Adams">
                </div>
                <div class="author-card-details">
                  <h5 class="author-card-name text-lg">{{ Auth::user()->email }}</h5>
                  <span
                    class="author-card-position"
                  >Joined {{ Auth::user()->created_at->format('M d, Y') }} </span>
                </div>
              </div>
            </div>
            <div class>
              <b-list-group>
                <b-list-group-item
                  class="d-flex justify-content-between align-items-center"
                >Deparment
                <b-badge variant="info" pill>{{Auth::user()->employee ? (Auth::user()->employee->department ? Auth::user()->employee->department->name : "Not Defined"):""}}</b-badge>
                </b-list-group-item>
              </b-list-group>
            </div>
          </div>
          <!-- Profile Settings-->
					<div class="col-lg-9 pb-5">
					<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Employee Profile</a>
							</div>
						</nav>
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
								<b-card title="Employee Information">
								<b-list-group>
									<b-list-group-item
										class="d-flex justify-content-between align-items-center"
									>First Name
										<b-badge variant="primary" pill>{{Auth::user()->first_name}}</b-badge>
									</b-list-group-item>

									<b-list-group-item
										class="d-flex justify-content-between align-items-center"
									>Middle Name
										<b-badge variant="primary" pill>{{Auth::user()->middle_name}}</b-badge>
									</b-list-group-item>

									<b-list-group-item
										class="d-flex justify-content-between align-items-center"
									>Last Name
										<b-badge variant="primary">{{Auth::user()->last_name}}</b-badge>
									</b-list-group-item>
									<b-list-group-item class="d-flex justify-content-between align-items-center">Email
										<b-badge variant="primary">{{Auth::user()->email}}</b-badge>
									</b-list-group-item>
     
								</b-list-group>
            

  
							</b-card>
							</div>
						</div>
					</div>
        </div>
      </b-card>
      @if(Auth::user()->employee->job_id=="1")         
        <b-card>
          <teachercourses teacher-id="{{Auth::user()->employee->id}}"/> 
        </b-card>
      @else
           
      @endif
@endsection
<style scoped>
body {
  background: #eee;
}
.widget-author {
  margin-bottom: 58px;
}
.author-card {
  position: relative;
  padding-bottom: 48px;
  background-color: #fff;
  box-shadow: 0 12px 20px 1px rgba(64, 64, 64, 0.09);
}
.author-card .author-card-cover {
  position: relative;
  width: 100%;
  height: 100px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.author-card .author-card-cover::after {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  content: "";
  opacity: 0.5;
}
.author-card .author-card-cover > .btn {
  position: absolute;
  top: 12px;
  right: 12px;
  padding: 0 10px;
}
.author-card .author-card-profile {
  display: table;
  position: relative;
  padding-right: 15px;
  padding-bottom: 16px;
  padding-left: 20px;
  z-index: 5;
}
.author-card .author-card-profile .author-card-avatar,
.author-card .author-card-profile .author-card-details {
  display: table-cell;
  vertical-align: middle;
}
.author-card .author-card-profile .author-card-avatar {
  width: 85px;
  border-radius: 50%;
  box-shadow: 0 8px 20px 0 rgba(0, 0, 0, 0.15);
  overflow: hidden;
}
.author-card .author-card-profile .author-card-avatar > img {
  display: block;
  width: 100%;
}
.author-card .author-card-profile .author-card-details {
  padding-top: 20px;
  padding-left: 15px;
}
.author-card .author-card-profile .author-card-name {
  margin-bottom: 2px;
  font-size: 14px;
  font-weight: bold;
}
.author-card .author-card-profile .author-card-position {
  display: block;
  color: #8c8c8c;
  font-size: 12px;
  font-weight: 600;
}
.author-card .author-card-info {
  margin-bottom: 0;
  padding: 0 25px;
  font-size: 13px;
}
.author-card .author-card-social-bar-wrap {
  position: absolute;
  bottom: -18px;
  left: 0;
  width: 100%;
}
.author-card .author-card-social-bar-wrap .author-card-social-bar {
  display: table;
  margin: auto;
  background-color: #fff;
  box-shadow: 0 12px 20px 1px rgba(64, 64, 64, 0.11);
}
.btn-style-1.btn-white {
  background-color: #fff;
}
.list-group-item i {
  display: inline-block;
  margin-top: -1px;
  margin-right: 8px;
  font-size: 1.2em;
  vertical-align: middle;
}
.mr-1,
.mx-1 {
  margin-right: 0.25rem !important;
}
.list-group-item.active:not(.disabled) {
  border-color: #e7e7e7;
  background: #fff;
  color: #ac32e4;
  cursor: default;
  pointer-events: none;
}
.list-group-flush:last-child .list-group-item:last-child {
  border-bottom: 0;
}
.list-group-flush .list-group-item {
  border-right: 0 !important;
  border-left: 0 !important;
}
.list-group-flush .list-group-item {
  border-right: 0;
  border-left: 0;
  border-radius: 0;
}
.list-group-item.active {
  z-index: 2;
  color: #fff;
  background-color: #007bff;
  border-color: #007bff;
}
.list-group-item:last-child {
  margin-bottom: 0;
  border-bottom-right-radius: 0.25rem;
  border-bottom-left-radius: 0.25rem;
}
a.list-group-item,
.list-group-item-action {
  color: #404040;
  font-weight: 600;
}
.list-group-item {
  padding-top: 16px;
  padding-bottom: 16px;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
  border: 1px solid #e7e7e7 !important;
  border-radius: 0 !important;
  color: #404040;
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  text-decoration: none;
}
.list-group-item {
  position: relative;
  display: block;
  padding: 0.75rem 1.25rem;
  margin-bottom: -1px;
  background-color: #fff;
  border: 1px solid rgba(0, 0, 0, 0.125);
}
.list-group-item.active:not(.disabled)::before {
  background-color: #ac32e4;
}
.list-group-item::before {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 3px;
  height: 100%;
  background-color: transparent;
  content: "";
}
</style>