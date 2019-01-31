<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="8">
          <b-card-group>
            <b-card no-body class="p-4">
              <b-card-body>
                <b-form @submit.prevent="handleLogin">
                  <h1>Login</h1>
                  <p class="text-muted">Sign In to your account</p>
                  <b-input-group class="mb-3">
                    <b-input-group-prepend>
                      <b-input-group-text>
                        <i class="far fa-user"></i>
                      </b-input-group-text>
                    </b-input-group-prepend>
                    <b-form-input
                      id="email"
                      type="email"
                      v-model="credentials.email"
                      :class="{'form-control': true, 'is-invalid': form.hasError('email')}"
                      name="email"
                      autofocus
                      autocomplete="off"
                    />
                    <span v-if="form.hasError('email')" class="invalid-feedback" role="alert">
                      <strong>{{ form.getError('email') }}</strong>
                    </span>
                  </b-input-group>
                  <b-input-group class="mb-4">
                    <b-input-group-prepend>
                      <b-input-group-text>
                        <i class="fas fa-lock"></i>
                      </b-input-group-text>
                    </b-input-group-prepend>
                    <b-form-input
                      id="password"
                      type="password"
                      v-model="credentials.password"
                      :class="{'form-control': true, 'is-invalid': form.hasError('email')}"
                      name="password"
                      autocomplete="off"
                    />
                    <span v-if="form.hasError('password')" class="invalid-feedback" role="alert">
                      <strong>{{ form.getError('password') }}</strong>
                    </span>
                  </b-input-group>
                  <b-row>
                    <b-col cols="6">
                      <b-button variant="primary" type="submit" class="px-4">Login</b-button>
                    </b-col>
                  </b-row>
                </b-form>
              </b-card-body>
            </b-card>
            <b-card no-body class="text-white bg-info py-5">
              <b-card-body class="text-center">
                <div>
                  <h2>KU Student Mail</h2>
                  <p>
                    <img height="180" :src="'/img/ku-logo.png'">
                  </p>
                  <b-button
                    variant="danger"
                    class="active mt-3"
                    @click.stop="socialLogin('google')"
                  >
                    <span>
                      <i class="fab fa-google-plus-g"></i>
                    </span>
                    <span class>Sign In with Gmail</span>
                  </b-button>
                </div>
              </b-card-body>
            </b-card>
          </b-card-group>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
import Form from "../../../services/FormService";
import AuthService from "../../../services/AuthService";
export default {
  name: "Login",
  data() {
    return {
      dataUrl: null,
      credentials: {
        email: "",
        password: ""
      },
      form: new Form()
    };
  },
  methods: {
    handleLogin() {
      AuthService.login(this.credentials)
        .then(user => {
          // dispatch calls action , commit calls mutations
          this.$store.dispatch("global/setCurrentUser", user);
          this.$toaster.success("Login successful.");
          this.$router.push("/dashboard");
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.form.record(error.response.data.errors);
          } else if (error.response.status === 401) {
            this.form.record({
              email: ["The credentials do not match our records."]
            });
          }
          this.$toaster.error("The credentials do not match our records.");
        });
    },
    socialLogin(provider) {
      AuthService.socialLoginProvider(provider)
        .then(user => {
          if (user.redirectUrl) {
            this.dataUrl = user.redirectUrl;
            window.location.href = user.redirectUrl;
          }
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.form.record(error.response.data.errors);
          } else if (error.response.status === 401) {
            this.form.record({
              email: ["The credentials do not match our records."]
            });
          }
          this.$toaster.error("The credentials do not match our records.");
        });
    }
  }
};
</script>


