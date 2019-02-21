<template>
  <div class="animated fadeIn">
    <!-- {{model}} -->
    <div class="container mt-5">
      <b-card>
        <div class="row">
          <div class="col-lg-4 pb-5">
            <!-- Account Sidebar-->
            <div class="author-card pb-3">
              <div class="author-card-profile">
                <div class="author-card-avatar">
                  <img :src="'img/Passportsizephoto.jpg'" alt="Daniel Adams">
                </div>
                <div class="author-card-details">
                  <h5 class="author-card-name text-lg">{{model.first_name}} {{model.last_name}}</h5>
                  <span
                    class="author-card-position"
                  >Joined {{ model.created_at | moment("MMMM D, YYYY") }}</span>
                </div>
              </div>
            </div>
            <div class>
              <b-list-group>
                <b-list-group-item
                  class="d-flex justify-content-between align-items-center"
                >Deparment
                  <b-badge pill>Computer Sciennce and Engineering</b-badge>
                </b-list-group-item>

                <b-list-group-item class="d-flex justify-content-between align-items-center">Level
                  <b-badge>Undergraduate</b-badge>
                </b-list-group-item>

                <b-list-group-item class="d-flex justify-content-between align-items-center">Year
                  <b-badge>4</b-badge>
                </b-list-group-item>
                <b-list-group-item
                  class="d-flex justify-content-between align-items-center"
                >Semester
                  <b-badge>2</b-badge>
                </b-list-group-item>
              </b-list-group>
            </div>
          </div>
          <!-- Profile Settings-->
          <div class="col-lg-8 pb-5">
            <b-card title="Profile Information">
              <b-list-group>
                <b-list-group-item
                  class="d-flex justify-content-between align-items-center"
                >First Name
                  <b-badge pill>{{model.first_name}}</b-badge>
                </b-list-group-item>

                <b-list-group-item
                  v-if="model.middle_name != null"
                  class="d-flex justify-content-between align-items-center"
                >Middle Name
                  <b-badge variant="primary" pill>{{model.middle_name}}</b-badge>
                </b-list-group-item>

                <b-list-group-item
                  class="d-flex justify-content-between align-items-center"
                >Last Name
                  <b-badge>{{model.last_name}}</b-badge>
                </b-list-group-item>
                <b-list-group-item class="d-flex justify-content-between align-items-center">Email
                  <b-badge>{{model.email}}</b-badge>
                </b-list-group-item>
                <b-list-group-item
                  class="d-flex justify-content-between align-items-center"
                >Date of Birth
                  <b-badge>{{model.user_profile.date_of_birth}}</b-badge>
                </b-list-group-item>
                <b-list-group-item class="d-flex justify-content-between align-items-center">Gender
                  <b-badge>{{model.user_profile.gender}}</b-badge>
                </b-list-group-item>
                <b-list-group-item class="d-flex justify-content-between align-items-center">Nationality
                  <b-badge>{{model.user_profile.nationality}}</b-badge>
                </b-list-group-item>
              </b-list-group>
            </b-card>
          </div>
        </div>
      </b-card>
    </div>
  </div>
</template>

<script>
import AuthService from "../../services/AuthService";
import Form from "../../services/FormService";
export default {
  components: {
    Form
  },
  data() {
    return {
      model: {
        first_name: null,
        last_name: null,
        middle_name: null,
        user_profile: {
          date_of_birth: null,
          email: null
        }
      },
      data: null,
      form: new Form()
    };
  },
  created() {
    AuthService.getCurrentUser()
      .then(profile => {
        this.model = profile;
      })
      .catch(error => {});
  }
};
</script>

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
