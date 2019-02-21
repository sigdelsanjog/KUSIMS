<template>
  <container>
    <div class="col-md-8">
      <card>
        <template slot="title">Register</template>
        <template slot="body">
          <form @submit.prevent="handleRegister" autocomplete="off">
            {{user}}
            <div class="form-group row">
              <label for="text" class="col-sm-4 col-form-label text-md-right">First Name</label>

              <div class="col-md-6">
                <input
                  id="first_name"
                  type="text"
                  :class="{'form-control': true, 'is-invalid': form.hasError('first_name')}"
                  name="first_name"
                  v-model="user.first_name"
                  autofocus
                >
                <span v-if="form.hasError('first_name')" class="invalid-feedback" role="alert">
                  <strong>{{ form.getError('first_name') }}</strong>
                </span>
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-4 col-form-label text-md-right">Last Name</label>

              <div class="col-md-6">
                <input
                  id="last_name"
                  type="text"
                  :class="{'form-control': true, 'is-invalid': form.hasError('last_name')}"
                  name="last_name"
                  v-model="user.last_name"
                  autofocus
                >
                <span v-if="form.hasError('last_name')" class="invalid-feedback" role="alert">
                  <strong>{{ form.getError('last_name') }}</strong>
                </span>
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>

              <div class="col-md-6">
                <input
                  id="email"
                  type="email"
                  :class="{'form-control': true, 'is-invalid': form.hasError('email')}"
                  name="email"
                  v-model="user.email"
                >
                <span v-if="form.hasError('email')" class="invalid-feedback" role="alert">
                  <strong>{{ form.getError('email') }}</strong>
                </span>
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-sm-4 col-form-label text-md-right">Password</label>

              <div class="col-md-6">
                <input
                  id="password"
                  type="password"
                  :class="{'form-control': true, 'is-invalid': form.hasError('password')}"
                  name="password"
                  v-model="user.password"
                >
                <span v-if="form.hasError('password')" class="invalid-feedback" role="alert">
                  <strong>{{ form.getError('password') }}</strong>
                </span>
              </div>
            </div>

            <div class="form-group row">
              <label
                for="password_confirmation"
                class="col-sm-4 col-form-label text-md-right"
              >Password Confirmation</label>

              <div class="col-md-6">
                <input
                  id="password_confirmation"
                  type="password"
                  :class="{'form-control': true, 
                                        'is-invalid': form.hasError('password_confirmation')}"
                  name="password_confirmation"
                  v-model="user.password_confirmation"
                >
                <span
                  v-if="form.hasError('password_confirmation')"
                  class="invalid-feedback"
                  role="alert"
                >
                  <strong>{{ form.getError('password_confirmation') }}</strong>
                </span>
              </div>
            </div>
            <div class="form-group row">
              <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>

              <div class="col-md-6">
                <select name="role" v-model="user.role_id" class="form-control">
                  <option value="1">Account</option>
                  <option value="2">HOD</option>
                  <option value="3">Administrator</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="role" class="col-md-4 col-form-label text-md-right">User Type</label>
              <div class="col-md-6">
                <select name="role" v-model="user.user_type" class="form-control">
                  <option value="1">Student</option>
                  <option value="2">Teacher</option>
                  <option value="3">Administrator</option>
                </select>
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
            </div>
          </form>
        </template>
      </card>
    </div>
  </container>
</template>

<script type="text/ecmascript-6">
import Container from "../../../components/Container";
import Card from "../../../components/Card";
import AuthService from "../../../services/AuthService";
import Form from "../../../services/FormService";

export default {
  name: "register",
  data() {
    return {
      user: {},
      form: new Form()
    };
  },
  components: {
    Card,
    Container
  },
  methods: {
    handleRegister() {
      AuthService.register(this.user)
        .then(user => {
          this.user = {};
          this.$router.push("/login");
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.form.record(error.response.data.errors);
            this.$toaster.error("The form has some validation errors.");
          }
        });
    }
  }
};
</script>

<style>
</style>
