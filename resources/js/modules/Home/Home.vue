<template>
  <container>
    <div class="col-md-6">
      <div class="card text-center">
        <img class="card-img-top" :src="'/img/ku-logo.png'" alt="Kathmandu University Logo">
        <div class="card-body">
          <h5 class="card-title">Welcome to Kathmandu Univerisity</h5>
          <h3 class="card-title">Student Management System</h3>
        
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
  </container>
</template>

<script>
import Container from "../../components/Container";

export default {
  name: "Home",
  data() {
    return {
      users: []
    };
  },
  components: {
    Container
  },
  created() {
    this.getAllUsers();
  },
  methods: {
    getAllUsers() {
      UserService.getAllUsers()
        .then(userList => {
          this.users = userList;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style>
</style>
